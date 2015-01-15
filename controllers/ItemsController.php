<?php

namespace app\controllers;

use Yii;
use app\models\Items;
use app\models\ItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ItemsController implements the CRUD actions for Items model.
 */
class ItemsController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Items models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Items model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Items model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Items();
        $auth = Yii::$app->authManager;

        if (Yii::$app->request->post())
        {
            $data = $_POST['data'];
            $model->name = $data[1];
            $role = $auth->createRole($data[1]);
            $role->description = $data[2];
            $role->data = '';

            if($auth->add($role)) {
                foreach ($data[0] as $key => $value) {
                    $child = $auth->getRole($value['data']['value']);
                    $auth->addChild($role,$child);
                }
                return $this->redirect(['index']);
            }
        } else {
            $nodes = $this->getNodesSelected($model->name);
            $nodes = json_encode($nodes);
            return $this->render('create', [
                'model' => $model,
                'nodes'=>$nodes,
            ]);
        }
    }

    public function guardatHijos($arbol)
    {

    }

    /**
     * Updates an existing Items model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $auth = Yii::$app->authManager;

        if (Yii::$app->request->post() && $model->save()){
            return $this->redirect(['index']);
        } else {
            $nodes = $this->getNodesSelected($model->name);
            $nodes = json_encode($nodes);
            return $this->render('update', [
                'model' => $model,
                'nodes'=>$nodes,
            ]);
        }
    }

    public function actionActualizar()
    {
        $auth = Yii::$app->authManager;

        if (Yii::$app->request->post())
        {
            $data = $_POST['data'];
            $model = $this->findModel($data[1]);
            $padre = $auth->getRole($data[1]);
            $auth->removeChildren($padre);
            $model->name = $data[1]; 
            $model->description = $data[2];
        }
        foreach ($data[0] as $key => $value) {
            $child = $auth->getRole($value['data']['value']);
            $auth->addChild($padre,$child);
        }

        if($model->save()) {
            return $this->redirect(['index']);
        }     
          
    }

    function getNodesSelected($padre)
    {
        $query = (new \yii\db\Query());
        $query->select('child')->from('items_hijos')->where('parent=:padre');
        $query->addParams([':padre'=>$padre]);
        $nodes = $query->all();

        return $nodes;
    }

    /**
     * Deletes an existing Items model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Items model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Items the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Items::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe');
        }
    }
}
