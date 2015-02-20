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
           
            $archivo->file = UploadedFile::getInstance($archivo, 'file');
            
            if (isset($archivo->file))
            {
                
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
        $archivo = new UploadForm();

        $archivo->file = UploadedFile::getInstance($archivo, 'file');

        $hora = strtotime('-'.$proceso->tiempo_max.' minutes', strtotime(date('H:i:s')));
        $hora = date('H:i:s', $hora);

        $d = Yii::$app->user->id; //id del abogado
        $perfil = $this->getPerfil($d);
        
        if(!(Yii::$app->user->can('dir_juridico')||Yii::$app->user->can('admin')))
        {
            if(date('Y-m-d') > $model->fecha || $hora > $model->hora)
            {
                $m = '0';
                return $this->redirect(['index', 'id_p' => $id_p, 'm'=>$m]);
            }
        }

        if ($model->load(Yii::$app->request->post())){

            if($model->save()) {
                $this->actualizarArchivo($id_p, $model, $archivo);
                return $this->redirect(['view', 'id' => $model->id_avance, 'id_p'=>$id_p]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'id_p'=>$id_p,
            ]);
        }

    }

    public function actualizarArchivo($id_p, $model, $archivo)
    {
        
        if (isset($archivo->file))
        {
            
            if ($archivo->validate()) {
                $filename = $archivo->file->baseName. '.' . $archivo->file->extension;
                if($model->archivo !== null){ unlink('juridico/' .$id_p.'/avances/'.$model->archivo);}                
                $model->archivo = $archivo->file->name;
                $archivo->file->saveAs('juridico/' .$id_p.'/avances/'.$filename);
                $model->save();
                return $this->redirect(['view', 'id' => $model->id_avance, 'id_p'=>$id_p]);
                
            }else{

                $m = 'Hubo un error al cargar el archivo';
                return $this->render('update', [
                    'model' => $model,
                    'id_p'=>$id_p,
                    'm'=>$m,
                ]);
            }

        }else{

            $m = 'Hubo un error al cargar el archivo';
            return $this->render('update', [
                'model' => $model,
                'id_p'=>$id_p,
                'm'=>$m,
            ]);
        }

    }

    public function getPerfil($id)
    {
        $query = (new \yii\db\Query());
        $query->select('perfil')->from('usuarios')->where('id_usuario=:id');
        $query->addParams([':id'=>$id]);
        $perfil = $query->scalar();

        return $perfil;
    }

    /**
     * Deletes an existing AvanceProceso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$id_p)
    {

        $avance = $this->findModel($id);
        if($avance->archivo !== null){ unlink('juridico/' .$id_p.'/avances/'.$avance->archivo);}
        $avance->delete();

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
