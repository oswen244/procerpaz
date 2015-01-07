<?php

namespace app\controllers;

use Yii;
use app\models\Planillas;
use app\models\PromotoresPlanillas;
use app\models\GastosPlanillas;
use app\models\Clientes;
use app\models\PlanillasSearch;
use app\models\PromotoresSearch;
use app\models\PromotoresPlanillasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * PlanillasController implements the CRUD actions for Planillas model.
 */
class PlanillasController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Planillas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlanillasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Planillas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new PromotoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModelLista = new PromotoresPlanillasSearch();
        $dataProviderLista = $searchModelLista->search(Yii::$app->request->queryParams,$id);

        $afiliados = $this->afiliados($id);

        $gastos_planilla = $this->gastosPlanilla($id);

        $totalGastosProm = $this->totalGastosProm($id);
        $totalGastosOtrosProm = $this->totalGastosOtrosProm($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelLista'=>$searchModelLista,
            'dataProviderLista'=>$dataProviderLista,
            'afiliados'=>$afiliados,
            'gastos_planilla'=>$gastos_planilla,
            'totalGastosProm'=>$totalGastosProm,
            'totalGastosOtrosProm'=>$totalGastosOtrosProm,
        ]);
    }

    public function totalGastosOtrosProm($id_planilla)
    {
        
        $query = (new \yii\db\Query());
        $query->select('SUM(valor) AS gastos')->from('gastos_planillas')->where('id_planilla=:id AND asumido_por="Promotores"');
        $query->addParams([':id'=>$id_planilla]);
        $total = $query->scalar();

        return $total;
    }

    public function totalGastosProm($id_planilla)
    {

        $query = (new \yii\db\Query());
        $query->select('SUM(gastos_promotor) AS gastos')->from('promotores_planillas')->where('id_planilla=:id');
        $query->addParams([':id'=>$id_planilla]);
        $total = $query->scalar();


        return $total;
    }

    public function afiliados($id_planilla)
    {
        $query = Clientes::find()->where('id_planilla=:id');
        $query->addParams([':id' => $id_planilla]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }

    public function gastosPlanilla($id_planilla)
    {
        $query = GastosPlanillas::find()->groupBy('asumido_por');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

    public function actionAsignar()
    {
        $ids = $_POST['data'];
        $query = "INSERT INTO promotores_planillas (id_promotor,id_planilla) VALUES";
        foreach ($ids[0] as $key => $value) {
            $query = $query."('".$value."','".$ids[1]."'),";
        }
        $query = substr($query, 0, -1);
        try {
           \Yii::$app->db->createCommand($query)->execute();
           $m = "Promotores asignados con exito a la planilla N°".$ids[1];
        } catch (Exception $e) {
            $m = $e->getMessage();
        }
        return $m;
    }

    public function actionGastos()
    {
        $data = $_POST['data'];
        $connection = \Yii::$app->db;
        try {
            $connection->createCommand()->update('promotores_planillas', ['gastos_promotor' => $data[1]], 'id_promotores_planillas='.$data[0])->execute();
            $m = 'Gasto modificado';
        } catch (Exception $e) {
            $m = $e->getMessage();
        }

        return $m;
    }

    /**
     * Creates a new Planillas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Planillas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_planilla]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Planillas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_planilla]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Planillas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Planillas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Planillas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Planillas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
