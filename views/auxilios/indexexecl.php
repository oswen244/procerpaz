<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuxiliosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['clientes/index']];
$this->params['breadcrumbs'][] = ['label' => $id_cliente, 'url' => ['clientes/view', 'id' => $id_cliente]];
$this->params['breadcrumbs'][] = 'Auxilios';
?>

<div class="col-md-12">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Regresar a información de cliente', ['clientes/view', 'id' => $id_cliente], ['class' => '']) ?></li>
            <li><?= Html::a('Listar clientes', ['clientes/index'], ['class' => '']) ?></a></li>
        </ul>
    </div>
    <div class="auxilios-index col-md-9">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id_auxilio',
                // 'tipo',
                // 'id_cliente',
                // 'porcentaje_aux',
                'monto',
                // 'num_meses',
                'fecha_auxilio',
                // 'proveedor',
                // 'estado',
                'tipo_auxilio',

            ],
            'toolbar' => [
                '{export}',
            ],
            'hover' => true,
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => '<i class="glyphicon glyphicon-usd"></i>  Auxilio exequial',
            ],
        ]); ?>

    </div>
</div>