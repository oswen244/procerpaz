<?php

namespace app\controllers;

use Yii;
use app\models\Promotores;
use app\models\PromotoresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PromotoresController implements the CRUD actions for Promotores model.
 */
class PromotoresController extends Controller
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
                        'actions' => ['index','view'],
                        'roles' => ['leer_promotores'],
                    ],
                    // [
                    //     'allow' => true,
                    //     'actions' => ['index','view'],
                    //     'roles' => ['leer_planillas'],
                    // ],
                    [
                        'allow' => true,
                        'actions' => ['index','create'],
                        'roles' => ['crear_promotores'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','update'],
                        'roles' => ['editar_promotores'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','delete'],
                        'roles' => ['borrar_promotores'],
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
     * Lists all Promotores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PromotoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Promotores model.
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
     * Creates a new Promotores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Promotores();

        if ($model->load(Yii::$app->request->post())){ 
            $model->estado = 1;
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id_promotor]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Promotores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_promotor]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Promotores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $promotor = $this->findModel($id);
        if($this->promPlanillas($id) !== '0'){
            $promotor->estado = 2;
            $promotor->save();
        }else{
            $promotor->delete();
        }
        // $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
     * Finds the Promotores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Promotores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Promotores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
