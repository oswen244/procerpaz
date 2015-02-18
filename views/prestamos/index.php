<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrestamosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestamos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-center"><?= Html::tag('h3', (isset($_GET['m'])) ? $_GET['m'] : '' ,['class'=> 'help-block']);?></div>
<div class="prestamos-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'text-center'],
        'columns' => [

            // 'id_prestamo',
            [
                'attribute' => 'id_cliente',
                'label'=>'Documento',
                'value' => function($model){
                    return $model->idCliente->num_id;
                },
            ],
            [
                'attribute' => 'id_cliente',
                'label'=>'Nombres',
                'value' => function($model){
                    return $model->idCliente->nombres;
                },
            ],
            [
                'attribute' => 'id_cliente',
                'label'=>'Apellidos',
                'value' => function($model){
                    return $model->idCliente->apellidos;
                },
            ],
            // 'id_cliente',
            [
                'attribute' => 'monto',
                'value' => function($data){ return "$ ".number_format($data->monto,0);}
            ],
            // 'monto',
            [
                'attribute' => 'interes_mensual',
                'value' => function($data){ return $data->interes_mensual."%";}
            ],
            // 'interes_mensual',
            'num_cuotas',
            [
                'attribute' => 'valor_cuota',
                'value' => function($data){ return "$ ".number_format($data->valor_cuota,0);}
            ],
            // 'valor_cuota',
            // 'fecha_prest',
            // 'fecha_rep',
            [
                'attribute' => 'id_estado',
                'label'=>'Estado',
                'value' => function($model){
                    return $model->idEstado->nombre;
                },
            ],
            // 'id_estado',

            [
                'label' => '', 
                'vAlign' => 'middle',
                'value' =>  function($data){
                    return  Html::a('', ['pagos-prestamos/index', 'id_prestamo'=>$data->id_prestamo], ['class' => 'act glyphicon glyphicon-usd', 'title'=>'Agregar pago']).'&nbsp'.
                            Html::a('', ['update', 'id'=>$data->id_prestamo], ['class' => 'act glyphicon glyphicon-pencil', 'title'=>'Editar']).'&nbsp'.
                            Html::a('', ['delete', 'id' => $data->id_prestamo], ['class' => 'act glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => '¿Está seguro que desea borrar este prestamo?',
                                'method' => 'post',
                            ],
                            'title'=>'Eliminar',

                        ]);
                },
                'format' => 'raw',
                'options'=>['width'=>'6%'],
            ],
        ],
        'toolbar' => [
            ['content'=>
                Html::a('Crear prestamo', ['create'], ['class' => 'btn btn-success'])
            ],
            '{export}',
        ],
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-usd"></i>  Prestamos',
        ],
    ]); ?>

</div>
