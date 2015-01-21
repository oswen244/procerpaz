<?php

namespace app\controllers;

use Yii;
use app\models\PagosPrestamos;
use app\models\Prestamos;
use app\models\PagosPrestamosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagosPrestamosController implements the CRUD actions for PagosPrestamos model.
 */
class PagosPrestamosController extends Controller
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
     * Lists all PagosPrestamos models.
     * @return mixed
     */
    public function actionIndex($id_prestamo)
    {
        $searchModel = new PagosPrestamosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id_prestamo);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_prestamo'=>$id_prestamo,
        ]);
    }

    /**
     * Displays a single PagosPrestamos model.
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
     * Creates a new PagosPrestamos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_prestamo)
    {
        $model = new PagosPrestamos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->cambiarEstado($id_prestamo);
            return $this->redirect(['index', 'id_prestamo' => $id_prestamo]);
        } else {
            $resto = $this->getCapital();
            $valor_cuota = $this->getCuota($id_prestamo);
            return $this->render('create', [
                'model' => $model,
                'id_prestamo'=>$id_prestamo,
                'resto'=>$resto,
                'cuota'=>$valor_cuota,
            ]);
        }
    }

    public function cambiarEstado($id_prestamo)
    {
        $model = $this->findModelPrestamos($id_prestamo);
        if($this->getTotal() === $model->num_cuotas){
            $model->id_estado = '10';
        }else{
            $model->id_estado = '9';
        }
        $model->save();
    }

    public function getCapital()
    {
        $query = (new \yii\db\Query());
        $query->select('MIN(capital)')->from('pagos_prestamos')->where('1');
        $capital = $query->scalar();

        return $capital;
    }

    public function getCuota($id_prestamo)
    {
        $query = (new \yii\db\Query());
        $query->select('(monto*(interes_mensual/100)) AS interes, valor_cuota')->from('prestamos')->where('id_prestamo=:id_prestamo');
        $query->addParams([':id_prestamo'=>$id_prestamo]);
        $cuota = $query->one();

        return $cuota;
    }

    public function getTotal()
    {
        $query = (new \yii\db\Query());
        $query->select('COUNT(*)')->from('pagos_prestamos');
        $total = $query->scalar();

        return $total-1;
    }
    /**
     * Updates an existing PagosPrestamos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$id_prestamo)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id_prestamo' => $id_prestamo]);
        } else {
            $resto = $this->getCapital();
            $valor_cuota = $this->getCuota($id_prestamo);
            return $this->render('update', [
                'model' => $model,
                'id_prestamo'=>$id_prestamo,
                'resto'=>$resto,
                'cuota'=>$valor_cuota,
            ]);
        }
    }

    /**
     * Deletes an existing PagosPrestamos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index','id_prestamo' => $id_prestamo]);
    }

    /**
     * Finds the PagosPrestamos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PagosPrestamos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PagosPrestamos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelPrestamos($id)
    {
        if (($model = Prestamos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
