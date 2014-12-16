<?php

namespace app\controllers;

use Yii;
use app\models\Auxilios;
use app\models\AuxiliosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuxiliosController implements the CRUD actions for Auxilios model.
 */
class AuxiliosController extends Controller
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
     * Lists all Auxilios models.
     * @return mixed
     */
    public function actionIndexdes()
    {
        $searchModel = new AuxiliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'1',0);

        return $this->render('indexdes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     public function actionIndexexe()
    {
        $searchModel = new AuxiliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'2',0);

        return $this->render('indexexe', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexdescl($id)
    {
        $searchModel = new AuxiliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'1',$id);

        return $this->render('indexdescl', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_cliente' => $id,
        ]);
    }

     public function actionIndexexecl($id)
    {
        $searchModel = new AuxiliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'2',$id);

        return $this->render('indexexecl', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_cliente' => $id,
        ]);
    }

    /**
     * Displays a single Auxilios model.
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
     * Creates a new Auxilios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Auxilios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_auxilio]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Auxilios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_auxilio]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Auxilios model.
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
     * Finds the Auxilios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Auxilios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Auxilios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
