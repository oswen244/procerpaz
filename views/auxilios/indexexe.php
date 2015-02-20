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
        'rowOptions' => ['class' => 'text-center'],
        'columns' => [

            // 'id_auxilio',
            [
                'attribute' => 'documento_cliente',
                'label'=> 'Documento',
                'value' => 'idCliente.num_id',
            ],
            [
                'attribute' => 'nombre_cliente',
                'label'=>'Nombres',
                'value' => 'idCliente.nombres',
            ],
            [
                'attribute' => 'apellido_cliente',
                'label'=>'Apellidos',
                'value' => 'idCliente.apellidos',
            ],
            // 'tipo',
            // 'porcentaje_aux',
            [
                'attribute' => 'monto',
                'value' => function($data){ return "$ ".number_format($data->monto,0);}
            ],
            [
                'attribute' => 'tipoAuxilio',
                'label'=>'Tipo de auxilio',
                'value' => 'tipoAuxilio.tipo_auxilio',
            ],
            // 'num_meses',
            'fecha_auxilio',
            // 'proveedor',
            // 'estado',
            // 'id_familiar',
            [
                'attribute'=>'id_familiar',
                'value'=> function ($model){
                    return $model->idFamiliar->nombres." ".$model->idFamiliar->apellidos."-".$model->idFamiliar->idParentezco->parentezco;
                }
            ],

            [
                    'label' => '', 
                    'vAlign' => 'middle',
                    'value' =>  function($data){
                        return  Html::a('', ['update', 'id'=>$data->id_auxilio, 'tipo' => $data->tipo], [
                            'class' => 'act glyphicon glyphicon-pencil', 
                        ]).'&nbsp'.Html::a('', ['delete', 'id' => $data->id_auxilio, 'tipo' => $data->tipo], [
                            'class' => 'act glyphicon glyphicon-trash',
                                'data' => [
                                    'confirm' => '¿Está seguro que desea borrar este auxilio?',
                                    'method' => 'post',
                                ]
                            ]);;
                    },
                    'format' => 'raw',
                    'options'=>['width'=>'5%'],
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
