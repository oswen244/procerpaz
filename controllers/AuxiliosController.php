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
        $tipo = '1';
        $searchModel = new AuxiliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$tipo,0);

        return $this->render('indexdes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tipo' => $tipo,
        ]);
    }

     public function actionIndexexe()
    {
        $tipo = '2';
        $searchModel = new AuxiliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$tipo,0);

        return $this->render('indexexe', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tipo' => $tipo,
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
    public function actionCreate($tipo)
    {
        $model = new Auxilios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($tipo == 1)
                return $this->redirect(['indexdes']);
            else
                return $this->redirect(['indexexe']);

        } else {
            $familiares ='';
            if($tipo == 1)
                $tipos = $this->buscarTipos('0');
            else
                $tipos = $this->buscarTipos('2');

            return $this->render('create', [
                'model' => $model,
                'tipo' => $tipo,
                'familiares' => $familiares,
                'tipos' => $tipos,
            ]);
        }
    }

    public function actionGetcliente(){
        $query = (new \yii\db\Query());
        $query->select('id_cliente, nombres, apellidos')->from('clientes')->where('num_id=:documento');
        $query->addParams([':documento'=>$_POST['data']]);
        $cliente = $query->one();
        \Yii::$app->response->format = 'json';

        return $cliente;
    }

    public function buscarTipos($offset)
    {
        $query = "SELECT id_tipo, tipo_auxilio FROM tipo_auxilio LIMIT 2 OFFSET ".$offset;
        $result = \Yii::$app->db->createCommand($query)->queryAll();

        return $result;
    }

    /**
     * @return mixed
     */
    private function idCliente($id){
        $query = (new \yii\db\Query());
        $query->select('num_id')->from('clientes')->where('id_cliente=:id');
        $query->addParams([':id'=>$id]);
        $numero = $query->scalar();

        return $numero;
    }
    /**
     * Updates an existing Auxilios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$tipo)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_auxilio]);
        } else {
            $num_id = $this->idCliente($model->id_cliente);
            $familiares = $this->buscarFamiliares($model->id_cliente);
            if($tipo == 1)
                $tipos = $this->buscarTipos('0');
            else
                $tipos = $this->buscarTipos('2');
            return $this->render('update', [
                'model' => $model,
                'tipo' => $tipo,
                'num_id'=>$num_id,
                'familiares'=>$familiares,
                'tipos' => $tipos,
            ]);
        }
    }

    /**
     * Deletes an existing Auxilios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$tipo)
    {
        $this->findModel($id)->delete();
        if($tipo == 1)
            return $this->redirect(['indexdes']);
        else
            return $this->redirect(['indexexe']);
    }

    public function actionFamiliares(){
        $query = (new \yii\db\Query());
        $query->select('id_cliente')->from('clientes')->where('num_id=:num_id AND id_estado=:estado');
        $query->addParams([':num_id' => $_POST['data'], ':estado' => '1']);
        $id_cliente = $query->scalar();
        
        $familiares = $this->buscarFamiliares($id_cliente);
        \Yii::$app->response->format = 'json';

        return $familiares;
    }

    public function buscarFamiliares($id_cliente){
        $query = (new \yii\db\Query());
        $query->select('nombres,apellidos')->from('familiares')->where('id_cliente=:id');
        $query->addParams([':id'=>$id_cliente]);
        $familiares = $query->all();

        return $familiares;
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
