<?php

namespace app\controllers;

use Yii;
use app\models\GastosPlanillas;
use app\models\GastosPlanillasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GastosPlanillasController implements the CRUD actions for GastosPlanillas model.
 */
class GastosPlanillasController extends Controller
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
     * Lists all GastosPlanillas models.
     * @return mixed
     */
    public function actionIndex($id_planilla)
    {
        $searchModel = new GastosPlanillasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id_planilla);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_planilla'=>$id_planilla,
        ]);
    }

    /**
     * Displays a single GastosPlanillas model.
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
     * Creates a new GastosPlanillas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_planilla)
    {
        $model = new GastosPlanillas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id_planilla' => $id_planilla]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'id_planilla'=>$id_planilla,
            ]);
        }
    }

    /**
     * Updates an existing GastosPlanillas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$id_planilla)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id_planilla' => $id_planilla]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'id_planilla'=>$id_planilla,
            ]);
        }
    }

    /**
     * Deletes an existing GastosPlanillas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $id_planilla)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index?id_planilla='.$id_planilla]);
    }

    /**
     * Finds the GastosPlanillas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GastosPlanillas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GastosPlanillas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
