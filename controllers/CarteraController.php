<?php 
	
	namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use app\models\UploadForm;
use SimpleExcel\SimpleExcel;


class CarteraController extends Controller
{
    public $path = '../web/uploads/';

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
                        'actions' => ['indexex','indexim','generar','cargar','upload','cargar'],
                        'roles' => ['cart'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['indexex','generar'],
                        'roles' => ['exp_cart'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['indexim','generar','upload','cargar'],
                        'roles' => ['imp_cart'],
                    ],
            	],
            
        	],
	        
        ];
    }

    public function actionIndexex() //Renderiza la vista para el archivo de exportacion
    {
    	$instituciones = $this->getInstituciones();
        return $this->render('indexex', [
        	'instituciones'=>$instituciones,
        ]);
    }

    public function actionIndexim()//Renderiza la vista para el archivo de importacion
    {
        $instituciones = $this->getInstituciones();
        return $this->render('indexim', [
            'instituciones'=>$instituciones,
        ]);
    }

    public function getInstituciones() //Devuelve las instituciones
    {
    	$query = (new \yii\db\Query());
    	$query->select('id_institucion,nombre')->from('instituciones');
    	$ins = $query->all();

    	return $ins;
    }

    public function actionGenerar() //Genera los archivos dependiendo del tipo (Nuevos o cancelaciones)
    {
        if(Yii::$app->request->post()){

            if($_POST['t_archivo'] === '1'){
                $query = "CALL nuevos_desc('".$_POST['institucion']."','".$_POST['cartera_fecha']."')";
                try {
                    $nuevos = \Yii::$app->db->createCommand($query)->queryAll();
                    $this->download_send_headers("NUEVO_" . date_format(date_create($_POST['cartera_fecha']),'Ym') ."_PROSERPAZ S A". ".csv");
                    $archivo = $this->array2csv($nuevos);
                } catch (Exception $e) {
                    $archivo = $e->getMessage();
                }
            }else{
                $query = "CALL cancel_desc('".$_POST['institucion']."','".$_POST['cartera_fecha']."')";
                try {
                    $nuevos = \Yii::$app->db->createCommand($query)->queryAll();
                    $this->download_send_headers("CANCEL_" . date_format(date_create($_POST['cartera_fecha']),'Ym') ."_PROSERPAZ S A". ".csv");
                    $archivo = $this->array2csv($nuevos);
                } catch (Exception $e) {
                    $archivo = $e->getMessage();
                }
            }
            return $archivo;
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

    public function actionUpload()
    {
        $model = new UploadForm();
        $excel = new SimpleExcel('csv');
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->validate()) {
                $filename = $this->path.$model->file->baseName. '.' . $model->file->extension;
                $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
                $cadena = $this->csv2Table($filename);
                $totalCol = $this->totalColumns($filename);                
            }
        }   
        $instituciones = $this->getInstituciones();
        return $this->render('indexim', [
            'instituciones'=>$instituciones,
            'cadena'=>$cadena,
            'totalCol'=>$totalCol,
            'filename'=>$filename,
        ]);
    }

     public function actionCargar() // procesa el Archivo de importacion y cambia los estados de los morosos
    {
        $model = new UploadForm();
        $excel = new SimpleExcel('csv');
        if (Yii::$app->request->isPost) {

            if ($model->validate()) {
                $filename = $_POST['archivo_nom'];
                $excel->parser->loadFile($filename);
                $foo = $excel->parser->getField();

                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    foreach ($foo as $key => $value) {
                        $fila = explode(';',$value[0]);
                        $sql = "CALL importar(".(int)$fila[$_POST['doc']-1].",'".$fila[$_POST['nom']-1]."',".(float)$fila[$_POST['mon']-1].",".(int)$_POST['institucion'].")";
                        \Yii::$app->db->createCommand($sql)->execute();
                    }
                    $transaction->commit();
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

                 $sql = "CALL morosos()";
                \Yii::$app->db->createCommand($sql)->execute();           
            }
            unlink($filename);
        }

        return $this->redirect(['indexim', 'm' =>'OK']);   

    }

    public function totalColumns($filename)//Obtiene el numero de columnas del archivo csv
    {
        $f = fopen($filename, "r");
        $line = fgetcsv($f);
        $cell = count(explode(';', $line[0]));
        fclose($f);

        return $cell;
    }

    public function csv2Table($filename) //Convierte la data del archivo csv a una tabla html
    {

        $cadena = "";
        $header = "<table class='table table-bordered table-striped'>";
        $f = fopen($filename, "r");


        //--------Contenido---------//
        while (($line = fgetcsv($f)) !== false) {
            $cadena = $cadena."<tr class='text-center'>";
            foreach ($line as $cell) {
                $cell = explode(';', $cell);
                foreach ($cell as $key) {
                    $cadena = $cadena."<td>" .utf8_encode ($key) . "</td>";
                }
            }
            $cadena = $cadena."</tr>";
        }
        //-------Header---------//
        $header = $header.'<tr>';
        for ($i=1; $i <= $this->totalColumns($filename) ; $i++) { 
            $header = $header."<th class='text-center'>Columna $i</th>";
        }
        $header = $header.'</tr>';
        $cadena = $header.$cadena;

        fclose($f);
        $cadena = $cadena."</table>";

        return $cadena;
    }
}

?>