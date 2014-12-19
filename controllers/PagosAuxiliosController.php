<?php

namespace app\controllers;

use Yii;
use app\models\PagosAuxilios;
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id_auxilio'=>$id_auxilio, 'monto' => $cuota]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'cuota' => $cuota,
                'id_auxilio'=>$id_auxilio,
            ]);
        }
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

        return $this->redirect(['index', 'id_auxilio'=>$id_auxilio, 'monto' => $cuota]);
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
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
