<?php

namespace app\controllers;

use Yii;
use app\models\ProcesoJuridico;
use app\models\ProcesoJuridicoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ProcesoJuridicoController implements the CRUD actions for ProcesoJuridico model.
 */
class ProcesoJuridicoController extends Controller
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
                        'roles' => ['leer_proc_jur'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','create'],
                        'roles' => ['crear_proc_jur'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','update'],
                        'roles' => ['editar_proc_jur'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','delete'],
                        'roles' => ['borrar_proc_jur'],
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
     * Lists all ProcesoJuridico models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProcesoJuridicoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProcesoJuridico model.
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
     * Creates a new ProcesoJuridico model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProcesoJuridico();

        if ($model->load(Yii::$app->request->post())){
            $model->hora = date('H:i:s');
            if($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $abogados = $this->getAbogados();
            $estados = $this->getEstados();
            return $this->render('create', [
                'model' => $model,
                'abogados'=>$abogados,
                'estados'=>$estados,
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

    public function getAbogados()
    {
        $query = (new \yii\db\Query());
        $query->select('id_usuario,nombres,apellidos,estado')->from('usuarios')->where('perfil="abogado"');
        $abog = $query->all();

        return $abog;
    }

    public function getEstados()
    {
        $query = (new \yii\db\Query());
        $query->select('id_estado,nombre')->from('estados')->where('entidad="ProcesoJuridico"');
        $estados = $query->all();

        return $estados;
    }

    /**
     * Updates an existing ProcesoJuridico model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){ 
            $model->hora = date('H:i:s');
            if($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $abogados = $this->getAbogados();
            $estados = $this->getEstados();
            return $this->render('update', [
                'model' => $model,
                'abogados'=>$abogados,
                'estados'=>$estados,
            ]);
        }
    }

    /**
     * Deletes an existing ProcesoJuridico model.
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
     * Finds the ProcesoJuridico model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProcesoJuridico the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProcesoJuridico::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
