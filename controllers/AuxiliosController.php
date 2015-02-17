<?php

namespace app\controllers;

use Yii;
use app\models\Auxilios;
use app\models\Familiares;
use app\models\AuxiliosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AuxiliosController implements the CRUD actions for Auxilios model.
 */
class AuxiliosController extends Controller
{
    public function behaviors()
    {
        return [
        'access' => [
                'class' => AccessControl::className(), //Permisos para las acciones
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
                        'actions' => ['indexdes','indexdescl','view'],
                        'roles' => ['leer_auxilio_des'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['indexexe','indexexecl','view'],
                        'roles' => ['leer_auxilio_exe'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['crear_auxilio_des'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['crear_auxilio_exe'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['editar_auxilio_des'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['editar_auxilio_exe'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['borrar_auxilio_des'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['borrar_auxilio_exe'],
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
     * Lists all Auxilios models.
     * @return mixed
     */
    public function actionIndexdes() //Lista los auxilios de desempleo
    {
        $tipo = '1';
        $searchModel = new AuxiliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$tipo,0);

        return $this->render('indexdes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tipo' => $tipo,
        ]);
    }

     public function actionIndexexe() // Lista los auxilios exequiales
    {
        $tipo = '2';
        $searchModel = new AuxiliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$tipo,0);

        return $this->render('indexexe', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tipo' => $tipo,
        ]);
    }

    public function actionIndexdescl($id) //Lista los auxilios de desempleo en el perfil del cliente
    {
        $searchModel = new AuxiliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'1',$id);

        return $this->render('indexdescl', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_cliente' => $id,
        ]);
    }

     public function actionIndexexecl($id) //Lista los auxilios exequiales en el perfil del cliente
    {
        $searchModel = new AuxiliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'2',$id);

        return $this->render('indexexecl', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_cliente' => $id,
        ]);
    }

    /**
     * Displays a single Auxilios model.
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
     * Creates a new Auxilios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tipo)
    {
        $model = new Auxilios();

        if ($model->load(Yii::$app->request->post()))
        { 

            if(isset($_POST['familiar']))
            {
                $fam = $this->findModelFamiliar($_POST['familiar']);
                $model->id_familiar = $fam->id_familiar;
            }
            if($model->save()) {
                if($tipo == 1){
                    return $this->redirect(['indexdes']);
                }else{
                    return $this->redirect(['indexexe']);
                }
            }else{
                
                return 'No guarda';
            }


        } else {
            $familiares = '';
            if($tipo == 1)
                $tipos = $this->buscarTipos('0');
            else
                $tipos = $this->buscarTipos('2');

            return $this->render('create', [
                'model' => $model,
                'tipo' => $tipo,
                'familiares' => $familiares,
                'tipos' => $tipos,
            ]);
        }
    }

    public function actionGetcliente() //Obtiene el id, nombres y apellidos del cliente pasando el número de identificación
    {
        $query = (new \yii\db\Query());
        $query->select('id_cliente, nombres, apellidos')->from('clientes')->where('num_id=:documento');
        $query->addParams([':documento'=>$_POST['data']]);
        $cliente = $query->one();
        \Yii::$app->response->format = 'json';

        return $cliente;
    }

    public function buscarTipos($offset)//Devuelve los tipos de auxilios de la base de datos
    {
        $query = "SELECT id_tipo, tipo_auxilio FROM tipo_auxilio LIMIT 2 OFFSET ".$offset;
        $result = \Yii::$app->db->createCommand($query)->queryAll();

        return $result;
    }

    /**
     * @return mixed
     */
    private function idCliente($id) //Devuelve el número de identificación del cliente pasando el id
    {
        $query = (new \yii\db\Query());
        $query->select('num_id')->from('clientes')->where('id_cliente=:id');
        $query->addParams([':id'=>$id]);
        $numero = $query->scalar();

        return $numero;
    }
    /**
     * Updates an existing Auxilios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$tipo)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($tipo === '1'){
                return $this->redirect(['indexdes']);
            }else{
                return $this->redirect(['indexexe']);
            }
        } else {
            $num_id = $this->idCliente($model->id_cliente);
            $familiares = $this->buscarFamiliares($model->id_cliente);
            if($tipo == 1)
                $tipos = $this->buscarTipos('0');
            else
                $tipos = $this->buscarTipos('2');
            return $this->render('update', [
                'model' => $model,
                'tipo' => $tipo,
                'num_id'=>$num_id,
                'familiares'=>$familiares,
                'tipos' => $tipos,
            ]);
        }
    }

    /**
     * Deletes an existing Auxilios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$tipo)
    {
        $this->findModel($id)->delete();
        if($tipo == 1)
            return $this->redirect(['indexdes']);
        else
            return $this->redirect(['indexexe']);
    }

    public function actionFamiliares() //
    {
        // Primero se busca el id del cliente
        $query = (new \yii\db\Query());
        $query->select('id_cliente')->from('clientes')->where('num_id=:num_id AND id_estado=:estado');
        $query->addParams([':num_id' => $_POST['data'], ':estado' => '1']);
        $id_cliente = $query->scalar();
        

        // Despues se listan los familiares
        $familiares = $this->buscarFamiliares($id_cliente);
        \Yii::$app->response->format = 'json';

        return $familiares;
    }

    public function buscarFamiliares($id_cliente) //Devuelve los familiares de un cliente pasando el id del cliente
    {
        $query = (new \yii\db\Query());
        $query->select('id_familiar,nombres,apellidos')->from('familiares')->where('id_cliente=:id');
        $query->addParams([':id'=>$id_cliente]);
        $familiares = $query->all();

        return $familiares;
    }


    /**
     * Finds the Auxilios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Auxilios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Auxilios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe');
        }
    }

    protected function findModelFamiliar($id)
    {
        if (($model = Familiares::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe');
        }
    }
}
