<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MensualidadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestamos';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['clientes/index']];
$this->params['breadcrumbs'][] = ['label' => $id_cliente, 'url' => ['clientes/view', 'id' => $id_cliente]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Regresar a información de cliente', ['clientes/view', 'id' => $id_cliente], ['class' => '']) ?></li>
            <li><?= Html::a('Listar clientes', ['clientes/index'], ['class' => '']) ?></a></li>
        </ul>
    </div>
    <div class="mensualidades-index col-md-9">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                   // 'id_prestamo',
                    // 'id_cliente',
                    'monto',
                    'interes_mensual',
                    // 'num_cuotas',
                    'valor_cuota',
                    // 'cuotas_pagadas',
                    // 'fecha_prest',
                    // 'fecha_rep',
                    'id_estado',

            ],
            'toolbar' => [
                '{export}',
            ],
            'hover' => true,
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => '<i class="glyphicon glyphicon-usd"></i>  Prestamos',
            ],
        ]); ?>

    </div>
</div>