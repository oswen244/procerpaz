<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuarios();
        

        if ($model->load(Yii::$app->request->post())) {
            if($model->perfil === 'abogado'){
                $model->estado = 1;
            }
            $model->contrasena = sha1($model->contrasena);
            if($model->save()){
                $model->perfil = str_replace(' ', '', $model->perfil);
                $role = Yii::$app->authManager->getRole($model->perfil);
                Yii::$app->authManager->assign($role, $model->id_usuario);
                return $this->redirect(['view', 'id' => $model->id_usuario]);
            }

        } else {

            $perfiles = $this->perfiles();
            return $this->render('create', [
                'model' => $model,
                'perfiles'=>$perfiles,
            ]);
        }
    }

    public function perfiles()
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

        if ($model->load(Yii::$app->request->post())){
            ($model->contrasena === '') ? $model->contrasena = $contrasena : $model->contrasena = sha1($model->contrasena);
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

    /**
     * Deletes an existing Usuarios model.
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
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
