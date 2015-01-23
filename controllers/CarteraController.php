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

    public function actionGenerar()
    {
        if(Yii::$app->request->post()){

            if($_POST['t_archivo'] === '1'){
                $query = "CALL nuevos_desc('".$_POST['institucion']."','".$_POST['cartera_fecha']."')";
                try {
                    $nuevos = \Yii::$app->db->createCommand($query)->queryAll();
                    $this->download_send_headers("NUEVO_" . date_format(date_create($_POST['cartera_fecha']),'Ym') ."_PROSERPAZ S A S". ".csv");
                    $archivo = $this->array2csv($nuevos);
                } catch (Exception $e) {
                    $archivo = $e->getMessage();
                }
                // \Yii::$app->response->format = 'json';
                return $archivo;
            }else{
                return 'archivo de cancelaciones';
            }
        }
    }

    public function array2csv(array &$array) //Escribe las lineas en el archivo temporal de salida output
    {
       if (count($array) == 0) {
         return null;
       }
       ob_start();
       $df = fopen("php://output", 'w');
       foreach ($array as $row) {
            fputcsv($df, $row, ';');
       }
       fclose($df);
       return ob_get_clean();
    }

    public function download_send_headers($filename) 
    {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }
}

?>