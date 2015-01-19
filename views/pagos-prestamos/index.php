<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PagosPrestamosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['prestamos/index']];
$this->title = 'Pagos Prestamos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
     <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li>
            <?= Html::a('Regresar a prestamos', ['prestamos/index'], ['class' => '']) ?>
           </li>
        </ul>
    </div>
    <div class="pagos-prestamos-index col-md-9">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => ['class' => 'text-center'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id_pagos',
                'capital',
                'amortizacion',
                'fecha',
                // 'id_prestamo',

                ['class' => 'yii\grid\ActionColumn'],
            ],
            'toolbar' => [
                ['content'=>
                    Html::a('Agregar pago', ['create','id_prestamo'=>$id_prestamo], ['class' => 'btn btn-success'])
                ],
                '{export}',
            ],
            'hover' => true,
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => '<i class="glyphicon glyphicon-usd"></i> Pagos de prestamos',
            ],
        ]); ?>

    </div>
</div>