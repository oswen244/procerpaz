<?php

namespace app\controllers;

use Yii;
use app\models\Planillas;
use app\models\Promotores;
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
use yii\filters\AccessControl;

/**
 * PlanillasController implements the CRUD actions for Planillas model.
 */
class PlanillasController extends Controller
{
    public function behaviors()
    {
        return [
        'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['login', 'logout', 'signup', 'index'],
                'rules' => [
                    [
                        'allow' => false,
                        // 'actions' => ['index'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        // 'actions' => ['*'],
                        'roles' => ['admin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','view'],
                        'roles' => ['leer_planillas'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['crear_planillas'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['editar_planillas'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['borrar_planillas'],
                    ],
                ],
            ],
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
        $dataProvider = $this->promotores($id);

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

    public function promotores($id)
    {
        $query = Promotores::find()->where('id_promotor NOT IN (SELECT id_promotor FROM promotores_planillas WHERE id_planilla =:id)');
        $query->addParams([':id'=>$id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
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

    public function serialPlanillas(){ // devuelve el id de la planilla con el numero mas alto
        $query = (new \yii\db\Query());
        $query->select('MAX(id_planilla)')->from('planillas');
        $planilla = $query->scalar();

        return $planilla;
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
        $totalClientes = $this->clientesPlanillas($id);
        $totalGastos = $this->gastosPlanillas($id);
        $totalpromo = $this->promPlanillas($id);
        if($totalClientes === '0' && $totalGastos==='0' && $totalpromo==='0'){
            $this->findModel($id)->delete();
            $m = 'Borrado exitoso';
        }else{
            $m = 'Imposible borrar planilla. Borre todos los elementos asociados primero';
        }

        return $this->redirect(['index', 'm'=>$m]);
    }

    public function clientesPlanillas($id)
    {
        $query = (new \yii\db\Query());
        $query->select('COUNT(*)')->from('clientes')->where('id_planilla=:id');
        $query->addParams([':id'=>$id]);
        $total = $query->scalar();

        return $total;
    }

    public function gastosPlanillas($id)
    {
        $query = (new \yii\db\Query());
        $query->select('COUNT(*)')->from('gastos_planillas')->where('id_planilla=:id');
        $query->addParams([':id'=>$id]);
        $total = $query->scalar();

        return $total;
    }

    public function promPlanillas($id)
    {
        $query = (new \yii\db\Query());
        $query->select('COUNT(*)')->from('promotores_planillas')->where('id_planilla=:id');
        $query->addParams([':id'=>$id]);
        $total = $query->scalar();

        return $total;
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
