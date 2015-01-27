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
                // ['class' => 'yii\grid\SerialColumn'],

                // 'id_pagos',
                // 'capital',
                [
                    'attribute'=>'capital',
                    'label'=>'Capital',
                    'pageSummary' => 'Total',
                ],
                // 'interes',
                [
                    'attribute'=>'interes',
                    'label'=>'Intereses',
                    'pageSummary' => true,
                ],
                // 'amortizacion',
                [
                    'attribute'=>'amortizacion',
                    'label'=>'Amortización',
                    'pageSummary' => true,
                ],
                // 'valor_cuota',
                [
                    'attribute'=>'valor_cuota',
                    'label'=>'Valor de cuota',
                    'pageSummary' => true,
                ],
                'fecha',
                // 'id_prestamo',

                [
                    'label' => '', 
                    'vAlign' => 'middle',
                    'value' =>  function($data){
                        return  Html::a('', ['update', 'id'=>$data->id_pagos, 'id_prestamo' => $data->id_prestamo], ['class' => 'glyphicon glyphicon-pencil', 'title'=>'Editar']).'&nbsp'.
                                Html::a('', ['delete', 'id'=>$data->id_pagos, 'id_prestamo' => $data->id_prestamo], ['class' => 'act glyphicon glyphicon-trash',
                                'data' => [
                                    'confirm' => '¿Está seguro que desea borrar este pago?',
                                    'method' => 'post',
                                ],
                                'title'=>'Eliminar',

                            ]);
                    },
                    'format' => 'raw',
                    'options'=>['width'=>'8%'],
                ],
            ],
            'toolbar' => [
                ['content'=>
                    Html::a('Agregar pago', ['create','id_prestamo'=>$id_prestamo], ['class' => 'btn btn-success'])
                ],
                '{export}',
            ],
            'hover' => true,
            'showPageSummary' => true,
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => '<i class="glyphicon glyphicon-usd"></i> Pagos de prestamos',
            ],
        ]); ?>

    </div>
</div>