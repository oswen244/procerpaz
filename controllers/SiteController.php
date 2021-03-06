<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Clientes;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['login', 'logout', 'signup', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        // 'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                   
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        
        if(Yii::$app->user->can('admin')){ //Verifica si existen obsequios vencidos y/o vencimiento de desafiliaciones provicionales
            $sql = "CALL vence_obsequio()";
            \Yii::$app->db->createCommand($sql)->execute();

            $sql = "CALL cambiar_estado_desafil()";
            \Yii::$app->db->createCommand($sql)->execute();

            $en_mora = Clientes::find()->where(['id_estado'=>5])->count();
            $desafiliados = Clientes::find()->where(['id_estado'=>3])->count();
        }
        $obs = $this->contarObsequios();
        return $this->render('index',[
                'obsequios'=>$obs,
                'mora'=>$en_mora,
                'desafil'=>$desafiliados,
        ]);
    }

    function contarObsequios()
    {
        $query = (new \yii\db\Query());
        $query->select('COUNT(*)')->from('obsequios')->where('fecha_ven BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE()');
        $obs = $query->scalar();

        return $obs;
    }

    public function actionLogin()
    {
        $this->layout = 'loginLayout';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        // return $this->goHome();
        return $this->redirect(['login']);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
