<?php

namespace app\controllers;

use Yii;
use app\models\ProcesoJuridico;
use app\models\Usuarios;
use app\models\ProcesoJuridicoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\models\UploadForm;
use yii\web\UploadedFile;

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
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
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
                    [
                        'allow' => true,
                        'actions' => ['configuracion'],
                        'roles' => ['borrar_proc_jur'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['guardar-config','abogados'],
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
        $d = Yii::$app->user->id; //id del abogado
        $perfil = $this->getPerfil($d);
        $searchModel = new ProcesoJuridicoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$d,$perfil);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function getPerfil($id)
    {
        $query = (new \yii\db\Query());
        $query->select('perfil')->from('usuarios')->where('id_usuario=:id');
        $query->addParams([':id'=>$id]);
        $perfil = $query->scalar();

        return $perfil;
    }

    public function actionAbogados() //Lista todos los abogados para la tabla
    {
        $query = Usuarios::find()->where('perfil="abogado"')->orderBy('estado');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $this->render('abogados', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionConfiguracion($id)
    {
        $model = $this->findModel($id);
        return $this->render('configuracion', [
            'model' => $model,
        ]);
    }

    public function actionGuardarConfig() //Guarda la configuracion del caso (tiempo y peso)
    {
        if (Yii::$app->request->post()){
            $model = $this->findModel($_POST['id_proceso']);
            $model->peso_max = $_POST['peso_max'];
            $model->tiempo_max = $_POST['tiempo_max'];

            if($model->update()){
                return $this->redirect(['index']);
            }else{
                return $this->render('configuracion', [
                    'model' => $model,
                ]);
            }
        }

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
    public function actionCreate($id)
    {
        $model = new ProcesoJuridico();

        if ($model->load(Yii::$app->request->post())){
            $model->hora = date('H:i:s');
            $usuario = $this->findModelUsuario($model->id_abogado);
            if($usuario->estado == 1){
                $usuario->estado = 2;
            }
            if($model->save() && $usuario->save()) {
                mkdir('juridico/'.$model->id_proceso);
                mkdir('juridico/'.$model->id_proceso.'/avances');
                mkdir('juridico/'.$model->id_proceso.'/otros');
                return $this->redirect(['index']);
            }
        } else {
            $abogados = $this->getAbogados();
            $estados = $this->getEstados();
            return $this->render('create', [
                'model' => $model,
                'abogados'=>$abogados,
                'estados'=>$estados,
                'id_usuario'=>$id,
            ]);
        }
    }

    public function actionGetcliente()//Obtiene el cliente pasando el núemero de documento
    {
        $query = (new \yii\db\Query());
        $query->select('id_cliente, nombres, apellidos')->from('clientes')->where('num_id=:documento');
        $query->addParams([':documento'=>$_POST['data']]);
        $cliente = $query->one();
        \Yii::$app->response->format = 'json';

        return $cliente;
    }

    public function getAbogados() //Obtiene los abogados
    {
        $query = (new \yii\db\Query());
        $query->select('id_usuario,nombres,apellidos,estado')->from('usuarios')->where('perfil="abogado"');
        $abog = $query->all();

        return $abog;
    }

    public function getEstados() //obtiene los estados relacionados con procesos juridicos
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
                'id_usuario'=>$id,
            ]);
        }
    }

    public function actionUpload() // carga los archivos relacionados con los casos
    {
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $caso = $_POST['id_proceso'];
            $proceso = $this->findModel($caso);
            $folder = $_POST['folder'];
            $model->file = UploadedFile::getInstance($model, 'file');

            if(($proceso->peso_max*1024*1024) < $model->file->size){
                $m = 'Tamaño del archivo es mayor a lo permitido';
            }else{
                if ($model->validate()) {
                    $filename = $model->file->baseName. '.' . $model->file->extension;
                    $model->file->saveAs('juridico/' .$caso.'/'. $folder.'/'.$filename);
                    $m = 'El archivo ha sido cargado con exito';
                    
                    return $this->redirect(['index','m'=>'1']);

                }
            }
            return $this->redirect(['index','m'=>'2']);

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
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }

     protected function findModelUsuario($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}
