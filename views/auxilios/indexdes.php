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
            // 'tipo',
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
            // 'porcentaje_aux',
            [
                'attribute' => 'porcentaje_aux',
                'value' => function($data){ return number_format($data->porcentaje_aux,0)."%";}
            ],
            // 'monto',
            'num_meses',
            'fecha_auxilio',
            // 'proveedor',
            [
                'attribute'=> 'estado',
                'label'=>'Estado',
                'value' => function($data){
                    if($data->estado == 1)
                        return 'En curso';
                    else
                        return 'Cancelado';
                },
            ],
            [
                'attribute' => 'tipoAuxilio',
                'label'=>'Tipo de auxilio',
                'value' => 'tipoAuxilio.tipo_auxilio',
            ],

            [
                'label' => 'Acciones', 
                'vAlign' => 'middle',
                'value' =>  function($data){
                    return  Html::a('', ['pagos-auxilios/index', 'id_auxilio'=>$data->id_auxilio, 'monto'=>$data->monto], ['class' => 'glyphicon glyphicon-usd', 'title'=>'Pagos']).'&nbsp'.
                            Html::a('', ['update', 'id'=>$data->id_auxilio, 'tipo' => $data->tipo], ['class' => 'act glyphicon glyphicon-pencil', 'title'=>'Editar']).'&nbsp'.
                            Html::a('', ['delete', 'id' => $data->id_auxilio, 'tipo' => $data->tipo], ['class' => 'act glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => '¿Está seguro que desea borrar este auxilio?',
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
                Html::a('Crear auxilio de desempleo', ['create', 'tipo'=> $tipo], ['class' => 'btn btn-success'])
            ],
            '{export}',
        ],
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-usd"></i>  Auxilio de desempleo',
        ],
    ]); ?>

</div>
