<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ObsequiosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Obsequios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obsequios-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => ['class' => 'text-center'],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_obsequios',
            'num_afil',
            'fecha_ven',
            'nombres',
            'apellidos',
            // 'telefono',
            // 'celular',
            // 'email:email',

            [
                'label' => '', 
                'vAlign' => 'middle',
                'value' =>  function($model){
                    return  Html::a('', ['delete', 'id' => $model->id_obsequios], ['class' => 'act glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => '¿Está seguro que desea borrar este cliente de la lista de obsequios vencidos?',
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
            '{export}',
            // '{toggleData}',
        ],
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-user"></i>  Clientes con obsequio vencido',
        ],
    ]); ?>

</div>
