<?php

namespace app\controllers;

use Yii;
use app\models\AvanceProceso;
use app\models\AvanceProcesoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvanceProcesoController implements the CRUD actions for AvanceProceso model.
 */
class AvanceProcesoController extends Controller
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
     * Lists all AvanceProceso models.
     * @return mixed
     */
    public function actionIndex($id_p)
    {
        $searchModel = new AvanceProcesoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id_p);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_proceso'=>$id_p,
        ]);
    }

    /**
     * Displays a single AvanceProceso model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$id_p)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'id_p'=>$id_p,
        ]);
    }

    /**
     * Creates a new AvanceProceso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_proceso)
    {
        $model = new AvanceProceso();

        if ($model->load(Yii::$app->request->post())){
            $model->hora = date('H:i:s');
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id_avance]);
            }else{
                return 'No salvó';
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'id_p'=>$id_proceso,
            ]);
        }
    }

    /**
     * Updates an existing AvanceProceso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_avance]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AvanceProceso model.
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
     * Finds the AvanceProceso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AvanceProceso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AvanceProceso::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
