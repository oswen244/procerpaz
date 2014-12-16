<?php

namespace app\controllers;

use Yii;
use app\models\Mensualidades;
use app\models\MensualidadesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MensualidadesController implements the CRUD actions for Mensualidades model.
 */
class MensualidadesController extends Controller
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
     * Lists all Mensualidades models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new MensualidadesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_cliente' => $id,
        ]);
    }

    /**
     * Displays a single Mensualidades model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$idc)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'id_cliente' => $idc,
        ]);
    }

    /**
     * Creates a new Mensualidades model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Mensualidades();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'id_cliente' => $id,
            ]);
        }
    }

    /**
     * Updates an existing Mensualidades model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$idc)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $idc]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'id_cliente'=> $idc,
            ]);
        }
    }

    /**
     * Deletes an existing Mensualidades model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$idc)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index?id='.$idc]);
    }

    /**
     * Finds the Mensualidades model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mensualidades the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mensualidades::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
