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
use yii\db\Query;

use app\models\Mensualidades;
use app\models\Prestamos;
use app\models\PagosPrestamos;


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
                    $this->download_send_headers("NUEVO_" . date_format(date_create($_POST['cartera_fecha']),'Ym') ."_1207_PROSERPAZ S A". ".csv");
                    $archivo = $this->array2csv($nuevos);
                } catch (Exception $e) {
                    $archivo = $e->getMessage();
                }
            }else{
                $query = "CALL cancel_desc('".$_POST['institucion']."','".$_POST['cartera_fecha']."')";
                try {
                    $nuevos = \Yii::$app->db->createCommand($query)->queryAll();
                    $this->download_send_headers("CANCEL_" . date_format(date_create($_POST['cartera_fecha']),'Ym') ."_1207_PROSERPAZ S A". ".csv");
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
        $cadena = "";
        $totalCol = 0;
        $filename = "";
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->validate()) {

                $filename = $this->path.$model->file->baseName. '.csv';

                if($model->file->extension === 'txt' || $model->file->extension === 'csv'){
                    $model->file->saveAs('uploads/' . $model->file->baseName . '.csv');
                    $cadena = $this->csv2Table($filename);
                    $totalCol = $this->totalColumns($filename);                
                }else{
                    $instituciones = $this->getInstituciones();
                    return $this->render('indexim', [
                        'instituciones'=>$instituciones,
                        'm' => "El archivo no es válido",
                    ]);
                }
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

    public function procesarExtension($filename)
    {
        $cadena = substr($filename, 0, -3);
        $cadena = $cadena.'csv';
        return $cadena;
    }

     public function actionCargar() // procesa el Archivo de importacion y cambia los estados de los morosos
    {
        $model = new UploadForm();
        $excel = new SimpleExcel('csv');
        $foo = "";
        $cont_prestamos = 0;
        $t = 0;
        if (Yii::$app->request->isPost) {

            if ($model->validate()) {

                $filename = $this->procesarExtension($_POST['archivo_nom']);
                $excel->parser->loadFile($filename);
                $foo = $excel->parser->getField();
                $t = count($foo);

                $sql = 'TRUNCATE ultimo_cargue';
                \Yii::$app->db->createCommand($sql)->execute();
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    foreach ($foo as $key => $value) {
                        $fila = explode(';',$value[0]);
                        $sql = "CALL importar(".(int)$fila[$_POST['doc']-1].",'".$fila[$_POST['nom']-1]."',".(float)$fila[$_POST['mon']-1].",".(int)$_POST['institucion'].")";
                        if($this->hasPrestamo((int)$fila[$_POST['doc']-1]) == 1){
                            $cont_prestamos = $cont_prestamos+1;
                        }
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

        $instituciones = $this->getInstituciones();
        return $this->render('indexim', [
                    'instituciones'=>$instituciones,
                    'm1' => "OK",
                    'tm'=>$t, 
                    'p'=>$cont_prestamos,
                    'cargue'=>1,
                ]);

        // return $this->redirect(['indexim', 'm' =>'OK', 'tm'=>$t, 'p'=>$cont_prestamos]);   

    }

    public function actionUltimoCargue()
    {
        $clientes_pagaron = (new Query)->select('*')->from('ultimo_cargue')->all();
        try {
            foreach ($clientes_pagaron as $cliente) {

                $mensualidad = Mensualidades::find()->where(['id_cliente'=>$cliente['id_cliente'], 'fecha_pago'=>$cliente['fecha']])->one();
          
                $mensualidad->delete();
                if($cliente['tiene_prestamo'] == 1)
                {
                    $prestamo = Prestamos::find()->where(['id_cliente'=>$cliente['id_cliente']])->orderBy('id_prestamo DESC')->one();
                    $ultimo_pago = PagosPrestamos::find()->where(['id_prestamo'=>$prestamo->id_prestamo, 'fecha'=>$cliente['fecha']])->one();
                    $ultimo_pago->delete();
                    $prestamo->id_estado = 11;
                    $prestamo->fecha_fin = null;
                    $prestamo->save();
                }
                
                $mensaje = 'La actualización fue reversada con exito!';
            }
        } catch (Exception $e) {
            $mensaje = 'Error: '.$e->getMessage();
            $instituciones = $this->getInstituciones();
            return $this->render('indexim', [
                'instituciones'=>$instituciones,
                'm1' => $mensaje,
            ]);
        }
        $instituciones = $this->getInstituciones();
         return $this->render('indexim', [
            'instituciones'=>$instituciones,
            'm1' => $mensaje,
        ]);
        
    }


    public function hasPrestamo($documento) //verifica si la persona tiene un prestamo para sumarlo en el contador de prestamos
    {
        $query = new Query();
        $query->select(["EXISTS(SELECT * FROM prestamos WHERE id_estado = 11 AND id_cliente = (SELECT id_cliente FROM clientes where num_id =".$documento."))"]);
        return $query->scalar();
    }

    public function totalColumns($filename)//Obtiene el numero de columnas del archivo csv
    {
        $f = fopen($filename, "r");
        $line = fgetcsv($f);
        $cell = count(explode(';', $line[0]));
        fclose($f);

        return $cell;
    }

    // public function multiexplode ($delimiters,$string) 
    // {
   
    //     $ready = str_replace($delimiters, $delimiters[0], $string);
    //     $launch = explode($delimiters[0], $ready);
    //     return  $launch;
    // }

    public function csv2Table($filename) //Convierte la data del archivo csv a una tabla html
    {

        $cadena = "";
        $header = "<table class='table table-bordered table-striped'>";
        $f = fopen($filename, "r");
        $totalColumnas = $this->totalColumns($filename);

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
        for ($i=1; $i <= $totalColumnas ; $i++) { 
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