<?php

namespace app\controllers;

use Yii;
use app\models\Prestamos;
use app\models\PagosPrestamos;
use app\models\PrestamosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PrestamosController implements the CRUD actions for Prestamos model.
 */
class PrestamosController extends Controller
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
                        'actions' => ['index','indexcl','view'],
                        'roles' => ['leer_prestamos'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','create'],
                        'roles' => ['crear_prestamos'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','update'],
                        'roles' => ['editar_prestamos'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','delete'],
                        'roles' => ['borrar_prestamos'],
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
     * Lists all Prestamos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrestamosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,0);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexcl($id)
    {
        $searchModel = new PrestamosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);

        return $this->render('indexcl', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_cliente' => $id,
        ]);
    }

    /**
     * Displays a single Prestamos model.
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
     * Creates a new Prestamos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Prestamos();
        $pagos = new PagosPrestamos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $pagos->capital = $model->monto;
            $pagos->id_prestamo = $model->id_prestamo;
            $pagos->save();
            return $this->redirect(['view', 'id' => $model->id_prestamo]);
        } else {
            $estados = $this->buscarEstados(); 
            return $this->render('create', [
                'model' => $model,
                'estados'=> $estados,
            ]);
        }
    }

    /**
     * Updates an existing Prestamos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_prestamo]);
        } else {
            $estados = $this->buscarEstados();
            $num_id = $this->idCliente($model->id_cliente);
            return $this->render('update', [
                'model' => $model,
                'estados'=> $estados,
                'num_id'=> $num_id,
            ]);
        }
    }

    /**
     * Deletes an existing Prestamos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetcliente(){
        $query = (new \yii\db\Query());
        $query->select('id_cliente, nombres, apellidos')->from('clientes')->where('num_id=:documento');
        $query->addParams([':documento'=>$_POST['data']]);
        $cliente = $query->one();
        \Yii::$app->response->format = 'json';

        return $cliente;
    }

    public function buscarEstados()
    {
        $query = (new \yii\db\Query());
        $query->select('id_estado, nombre')->from('estados')->where('entidad=:entidad');
        $query->addParams([':entidad'=>'Prestamos']);
        $instituciones = $query->all();

        return $instituciones;
    }

    public function idCliente($id)
    {
        $query = (new \yii\db\Query());
        $query->select('num_id')->from('clientes')->where('id_cliente=:id');
        $query->addParams([':id'=>$id]);
        $numero = $query->scalar();

        return $numero;
    }

    /**
     * Finds the Prestamos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prestamos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prestamos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
