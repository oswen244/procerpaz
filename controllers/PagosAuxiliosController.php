<?php

namespace app\controllers;

use Yii;
use app\models\PagosAuxilios;
use app\models\Auxilios;
use app\models\PagosAuxiliosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagosAuxiliosController implements the CRUD actions for PagosAuxilios model.
 */
class PagosAuxiliosController extends Controller
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
     * Lists all PagosAuxilios models.
     * @return mixed
     */
    public function actionIndex($id_auxilio,$monto)
    {
        $searchModel = new PagosAuxiliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id_auxilio);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_auxilio'=>$id_auxilio,
            'cuota' => $monto,
        ]);
    }

    /**
     * Displays a single PagosAuxilios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PagosAuxilios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuota,$id_auxilio)
    {
        $model = new PagosAuxilios();

        if ($model->load(Yii::$app->request->post())){
            $this->cambiarEstado($id_auxilio);
            if($model->save()) {
                return $this->redirect(['index', 'id_auxilio'=>$id_auxilio, 'monto' => $cuota]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'cuota' => $cuota,
                'id_auxilio'=>$id_auxilio,
            ]);
        }
    }

    public function cambiarEstado($id_auxilio)
    {
        $model = $this->findModelAuxilios($id_auxilio);

        if($model->num_meses === ($this->getTotal($id_auxilio)+1)){
            $model->estado = '2';
        }else{
            $model->estado = '1';
        }
        $model->save();
    }

    public function getTotal($id_auxilio)
    {
        $query = (new \yii\db\Query());
        $query->select('COUNT(*)')->from('pagos_auxilios')->where('id_auxilio=:id');
        $query->addParams([':id'=>$id_auxilio]);
        $total = $query->scalar();

        return $total;
    }
    /**
     * Updates an existing PagosAuxilios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$id_auxilio,$cuota)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pago]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'cuota' => $cuota,
                'id_auxilio'=>$id_auxilio,
            ]);
        }
    }

    /**
     * Deletes an existing PagosAuxilios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$id_auxilio,$cuota)
    {
        $this->findModel($id)->delete();
        $model = $this->findModelAuxilios($id_auxilio);
        $model->estado = '1';
        if($model->save()){
            return $this->redirect(['index', 'id_auxilio'=>$id_auxilio, 'monto' => $cuota]);
        }
    }

    /**
     * Finds the PagosAuxilios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PagosAuxilios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PagosAuxilios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
    protected function findModelAuxilios($id)
    {
        if (($model = Auxilios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}
