<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProcesoJuridicoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Procesos Juridicos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proceso-juridico-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => ['class' => 'text-center'],
        'filterModel' => $searchModel,
        'beforeHeader'=>[
            [
                'columns'=>[
                    ['content'=>'Cliente', 'options'=>['colspan'=>3, 'class'=>'text-center']],
                    ['content'=>'Abogado', 'options'=>['colspan'=>2, 'class'=>'text-center']],
                    ['content'=>'Proceso', 'options'=>['colspan'=>2, 'class'=>'text-center']],
                ],
                'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_proceso',
            [
                'attribute'=>'id_cliente',
                'label'=>'Nombres',
                'value'=> function($model){
                    return $model->idCliente->nombres;
                }
            ],
             [
                'attribute'=>'id_cliente',
                'label'=>'Apellidos',
                'value'=> function($model){
                    return $model->idCliente->apellidos;
                }
            ],
            // 'id_abogado',
            [
                'attribute'=>'id_abogado',
                'label'=>'Nombres',
                'value'=> function ($model){
                    return $model->idAbogado->nombres;
                }
            ],
            [
                'attribute'=>'id_abogado',
                'label'=>'Apellidos',
                'value'=> function ($model){
                    return $model->idAbogado->apellidos;
                }
            ],
            // 'tiempo_max',
            // 'id_estado',
            [
                'attribute'=>'id_estado',
                'label'=>'Estado',
                'value'=> function($model){
                    return $model->idEstado->nombre;
                }
            ],
            // 'peso_max',
            'fecha',
            // 'hora',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
        'toolbar' => [
            ['content'=>
                Html::a('Crear proceso', ['create'], ['class' => 'btn btn-success'])
            ],
            '{export}',
        ],
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-folder-open"></i>  Procesos Jurídicos',
        ],
    ]); ?>

</div>
