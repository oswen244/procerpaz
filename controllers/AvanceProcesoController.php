<?php

namespace app\controllers;

use Yii;
use app\models\AvanceProceso;
use app\models\AvanceProcesoSearch;
use app\models\ProcesoJuridico;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * AvanceProcesoController implements the CRUD actions for AvanceProceso model.
 */
class AvanceProcesoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all AvanceProceso models.
     * @return mixed
     */
    public function actionIndex($id_p) //Se listan los avances solo del proceso seleccionado
    {
        $searchModel = new AvanceProcesoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id_p);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_proceso'=>$id_p,
        ]);
    }

    /**
     * Displays a single AvanceProceso model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$id_p)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'id_p'=>$id_p,
        ]);
    }

    /**
     * Creates a new AvanceProceso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_proceso)
    {
        $model = new AvanceProceso();
        $archivo = new UploadForm();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->hora = date('H:i:s');
            $model->fecha = date('Y-m-d');
            $model->usuario = Yii::$app->user->identity->username;
           
            if ($archivo->load(Yii::$app->request->Post()))
            {
                $archivo->file = UploadedFile::getInstance($archivo, 'file');
                
                if ($archivo->validate()) {
                    $filename = $archivo->file->baseName. '.' . $archivo->file->extension;
                    $model->archivo = $archivo->file->name;
                    $archivo->file->saveAs('juridico/' .$id_proceso.'/avances/'.$filename);

                    if($model->save()){
                        return $this->redirect(['view', 'id' => $model->id_avance, 'id_p'=>$id_proceso]);
                    }else{
                        $m = 'Hubo un error al cargar el archivo';
                        return $this->render('create', [
                            'model' => $model,
                            'id_p'=>$id_proceso,
                            'm'=>$m,
                        ]);
                    }
                    
                }else{

                    $m = 'Hubo un error al cargar el archivo';
                    return $this->render('create', [
                        'model' => $model,
                        'id_p'=>$id_proceso,
                        'm'=>$m,
                    ]);
                }

            }else{
                if($model->save()){
                     return $this->redirect(['view', 'id' => $model->id_avance, 'id_p'=>$id_proceso]);
                }
            }

          
        } else {
            return $this->render('create', [
                'model' => $model,
                'id_p'=>$id_proceso,
            ]);
        }
    }


    public function actionUpload() // carga los archivos relacionados con los casos
    {
        $archivo = new UploadForm();
        if (Yii::$app->request->isPost) {
            $caso = $_POST['id_proceso'];
            $proceso = $this->findarchivo($caso);
            $folder = $_POST['folder'];
            $archivo->file = UploadedFile::getInstance($archivo, 'file');
            
            if ($archivo->validate()) {
                $filename = $archivo->file->baseName. '.' . $archivo->file->extension;
                $archivo->file->saveAs('juridico/' .$caso.'/'. $folder.'/'.$filename);
                $m = 'El archivo ha sido cargado con exito';
                
                return $this->redirect(['create','m'=>$m]);
            }
            
            return $this->redirect(['index','m'=>'Hubo un error al cargar el archivo']);

        }

    }

    /**
     * Updates an existing AvanceProceso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $id_p)
    {
        $model = $this->findModel($id);
        $proceso = $this->findModelProceso($id_p);

        $hora = strtotime('-'.$proceso->tiempo_max.' minutes', strtotime(date('H:i:s')));
        $hora = date('H:i:s', $hora);

        if($hora > $model->hora){
            $m = 'Tiempo agotado para modificar ese avance';
            return $this->redirect(['index', 'id_p' => $id_p, 'm'=>$m]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_avance]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'id_p'=>$id_p,
            ]);
        }

    }

    /**
     * Deletes an existing AvanceProceso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$id_p)
    {

        //PREGUNTAR POR LA HORA Y ELIMINAR EL ARCHIVO RELACIONADO SI EXISTE

        $this->findModel($id)->delete();

        return $this->redirect(['index?id_p='.$id_p]);
    }


    protected function findModelProceso($id)
    {
        if (($model = ProcesoJuridico::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }

    /**
     * Finds the AvanceProceso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AvanceProceso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AvanceProceso::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
