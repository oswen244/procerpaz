<?php 
	
	namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


class CarteraController extends Controller
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
                    
            	],
            
        	],
	        
        ];
    }

    public function actionIndexex()
    {
    	$instituciones = $this->getInstituciones();
        return $this->render('indexex', [
        	'instituciones'=>$instituciones,
        ]);
    }

    public function getInstituciones()
    {
    	$query = (new \yii\db\Query());
    	$query->select('id_institucion,nombre')->from('instituciones');
    	$ins = $query->all();

    	return $ins;
    }
}

?>