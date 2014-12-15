<?php

namespace app\controllers;

use Yii;
use app\models\Clientes;
use app\models\ClientesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Familiares;
use app\models\FamiliaresSearch;

/**
 * ClientesController implements the CRUD actions for Clientes model.
 */
class ClientesController extends Controller
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
     * Lists all Clientes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Client's Familiares models.
     * @param integer $id
     * @return mixed
     */
    public function actionFamiliares($id)
    {
        $familiar = new Familiares();

        $searchModel = new FamiliaresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);

        return $this->render('indexFamiliares', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'familiar' => $familiar,
            'id_cliente' => $id,
        ]);
    }

    /**
     * Displays a single Clientes model.
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
     * Displays a single Familiar model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewFamiliar($id,$idc)
    {
        $familiar = new Familiares();

       return $this->render('viewFamiliares', [
            'familiar' => $this->findFamiliar($id),
            'id_cliente' => $idc,
        ]);
    }

    /**
     * Creates a new Clientes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clientes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_cliente]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

     /**
     * Creates a new Clientes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateFamiliares($id)
    {
        $familiar = new Familiares();

        if ($familiar->load(Yii::$app->request->post()) && $familiar->save()) {
            return $this->redirect(['familiares', 'id' => $id]);
        } else {
            return $this->render('createFamiliares', [
                'familiar' => $familiar,
                'id_cliente' => $id,
            ]);
        }
    }

    /**
     * Updates an existing Clientes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_cliente]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

     /**
     * Updates an existing Clientes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateFamiliar($id,$idc)
    {
        $familiar = $this->findfamiliar($id);

        if ($familiar->load(Yii::$app->request->post()) && $familiar->save()) {
            return $this->redirect(['view-familiar', 'id' => $familiar->id_familiar]);
        } else {
            return $this->render('updateFamiliares', [
                'familiar' => $familiar,
                'id_cliente' => $idc,
            ]);
        }
    }

    /**
     * Deletes an existing Clientes model.
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
     * Deletes an existing Clientes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteFamiliar($id)
    {

        $this->findFamiliar($id)->delete();

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the Clientes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clientes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clientes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findFamiliar($id)
    {
        if (($model = Familiares::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
