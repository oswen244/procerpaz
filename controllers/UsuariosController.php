<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\Promotores;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UploadFormImages;
use yii\web\UploadedFile;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
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
                        'actions' => ['index','view','update','upload','delete-foto'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if($action->id === 'view' || $action->id === 'update'){
                if(($_GET['id'] == Yii::$app->user->id) || Yii::$app->user->can('admin')){
                    return true;
                }else{
                    throw new \yii\web\HttpException(403,'No tiene permiso para realizar esta acción.');
                }
            }else{
                if(Yii::$app->user->can('admin') || $action->id === 'upload' || $action->id === 'delete-foto'){
                    return true;
                }else{
                    throw new \yii\web\HttpException(403,'No tiene permiso para realizar esta acción.');
                }
            }
        } else {
            throw new \yii\web\HttpException(403,'No tiene permiso para realizar esta acción.');
        }
    }

    /**
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpload()
    {
        $model = new UploadFormImages();
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                $usuario = $this->findModel($model->usuario);
                ($usuario->foto_perfil !== 'default.png') ? unlink('images/perfiles/'.$usuario->foto_perfil) : '';
                $imagen = md5(time()).'.'. $model->file->extension;
                $model->file->saveAs('images/perfiles/'.$imagen);
                $usuario->foto_perfil = $imagen;
                $usuario->save();
            }else{
                $m = '0';
            }
        }
        return $this->redirect(['view', 'id' => $model->usuario, 'm' => '1']);
    }

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuarios();
        

        if ($model->load(Yii::$app->request->post())) {
            $model->estado = 1;

            Yii::$app->mailer->compose('credenciales',['usuario'=>$model->usuario, 'pass'=>$model->contrasena])
            ->setFrom('sistemagestion@proserpaz.com')
            ->setTo($model->email)
            ->setSubject('Prueba')
            // ->setTextBody('Este es el contenido del mensaje')
            ->send();

            $model->contrasena = sha1($model->contrasena);
            $model->perfil = str_replace(' ', '', $model->perfil);
            if($model->save()){
                $role = Yii::$app->authManager->getRole($model->perfil);
                Yii::$app->authManager->assign($role, $model->id_usuario);
                return $this->redirect(['view', 'id' => $model->id_usuario]);
            }
            
            $perfiles = $this->perfiles();
            return $this->render('create', [
                'model' => $model,
                'perfiles'=>$perfiles,
            ]);

        } else {

            $perfiles = $this->perfiles();
            return $this->render('create', [
                'model' => $model,
                'perfiles'=>$perfiles,
            ]);
        }
    }

    public function perfiles() //Lista los perfiles creados y básicos
    {
        $query = (new \yii\db\Query());
        $query->select('name,description')->from('items')->where('data<>1');
        $perfiles = $query->all();

        return $perfiles;
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $contrasena = $model->contrasena; //contraseña anterior en sha1

        if ($model->load(Yii::$app->request->post())){

            if($model->contrasena !== $contrasena){
                
                 Yii::$app->mailer->compose('credenciales',['usuario'=>$model->usuario, 'pass'=>$model->contrasena])
                ->setFrom('sistemagestion@proserpaz.com')
                ->setTo($model->email)
                ->setSubject('Prueba')
                // ->setTextBody('Este es el contenido del mensaje')
                ->send();
                $model->contrasena = sha1($model->contrasena);
            }
            $role = Yii::$app->authManager->getRole($model->perfil);
            if($model->perfil !== ''){
                Yii::$app->authManager->revokeAll($id);
                Yii::$app->authManager->assign($role, $id);
            }
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id_usuario]);
            }
        } else {
            $perfiles = $this->perfiles();
            return $this->render('update', [
                'model' => $model,
                'perfiles'=>$perfiles,
            ]);
        }
    }

    public function actionMarcarPromotor($id)
    {
        $promotor = new Promotores();
        $usuario = $this->findModel($id);
        $promotor->nombres = $usuario->nombres;
        $promotor->apellidos = $usuario->apellidos;
        $promotor->save();
        $usuario->promotor = $promotor->id_promotor;
        if($usuario->save()){
            return $this->redirect(['view', 'id' => $usuario->id_usuario]);            
        }else{
            return $this->redirect(['view', 'id' => $usuario->id_usuario, 'm' => 'Error']);
        }
    }

    public function actionDesmarcarPromotor($id)
    {
        $usuario = $this->findModel($id);
        $promotor = $this->findModelPromotor($usuario->promotor);
        $m = '';
        if($this->promPlanillas($promotor->id_promotor) !== '0'){
            $m = 'Desvincule al usuario de la(s) planilla(s) antes de desmarcar';
        }else{
            $promotor->delete();
            $usuario->promotor = '0';
        }
        if($usuario->save()){
           return $this->redirect(['view', 'id' => $usuario->id_usuario, 'm' => $m]);             
        }
    }

    public function promPlanillas($id)
    {
        $query = (new \yii\db\Query());
        $query->select('COUNT(*)')->from('promotores_planillas')->where('id_promotor=:id');
        $query->addParams([':id'=>$id]);
        $r = $query->scalar();

        return $r;
    }


    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $usuario = $this->findModel($id);
        $usuario->estado = '3';
        $usuario->save();
        // $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteFoto($id)
    {
        $model = $this->findModel($id);
        $imagen = 'images/perfiles/'.$model->foto_perfil;
        if($model->foto_perfil !== 'default.png'){
            unlink($imagen);
            $model->foto_perfil = 'default.png';
            $model->save();
        }
       
        return $this->redirect(['view', 'id' => $model->id_usuario]);
    }

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }

    protected function findModelPromotor($id)
    {
        if (($model = Promotores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
   
}
