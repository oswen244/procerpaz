<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MensualidadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mensualidades';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['clientes/index']];
$this->params['breadcrumbs'][] = ['label' => $id_cliente, 'url' => ['clientes/view', 'id' => $id_cliente]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Regresar a información de cliente', ['clientes/view', 'id' => $id_cliente], ['class' => '']) ?></li>
            <li><a href="index">Listar clientes</a></li>
        </ul>
    </div>
    <div class="mensualidades-index col-md-9">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id_mensualidad',
                'fecha_pago',
                'monto',
                // 'total_cuotas',
                // 'id_cliente',

                ['class' => '\kartik\grid\ActionColumn'],

            ],
            'toolbar' => [
                ['content'=>
                    Html::a('Agregar Mensualidad', ['create', 'id' => $id_cliente], ['class' => 'btn btn-success'])
                ],
                '{export}',
            ],
            'hover' => true,
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => '<i class="glyphicon glyphicon-usd"></i>  Mensualidades',
            ],
        ]); ?>

    </div>
</div>
