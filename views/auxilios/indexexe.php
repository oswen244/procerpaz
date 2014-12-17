<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuxiliosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = 'Auxilios';
?>
<div class="auxilios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_auxilio',
            'id_cliente',
            // 'tipo',
            // 'porcentaje_aux',
            'monto',
            'tipo_auxilio',
            // 'num_meses',
            'fecha_auxilio',
            // 'proveedor',
            // 'estado',
            'familiar',

            [
                    'label' => 'Actions', 
                    'vAlign' => 'middle',
                    'value' =>  function($data){
                        return  Html::a('', ['view', 'id'=>$data->id_auxilio], [
                            'class' => 'glyphicon glyphicon-eye-open', 
                        ]).'&nbsp'.Html::a('', ['update', 'id'=>$data->id_auxilio, 'tipo' => $data->tipo], [
                            'class' => 'act glyphicon glyphicon-pencil', 
                        ]).'&nbsp'.Html::a('', ['delete', 'id' => $data->id_auxilio], [
                            'class' => 'act glyphicon glyphicon-trash',
                                'data' => [
                                    'confirm' => '¿Está seguro que desea borrar este auxilio?',
                                    'method' => 'post',
                                ]
                            ]);;
                    },
                    'format' => 'raw',
                    
            ],
        ],
        'toolbar' => [
            ['content'=>
                Html::a('Crear auxilio exequial', ['create', 'tipo'=> $tipo], ['class' => 'btn btn-success'])
            ],
            '{export}',
        ],
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-usd"></i>  Auxilio exequial ',
        ],
    ]); ?>

</div>
