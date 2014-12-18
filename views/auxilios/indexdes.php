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
            // 'tipo',
            'id_cliente',
            'porcentaje_aux',
            // 'monto',
            'num_meses',
            'fecha_auxilio',
            // 'proveedor',
            'estado',
            'tipo_auxilio',

            [
                'label' => 'Actions', 
                'vAlign' => 'middle',
                'value' =>  function($data){
                    return  Html::a('', ['pagos-auxilios/index', 'id_auxilio'=>$data->id_auxilio], ['class' => 'glyphicon glyphicon-usd', 'title'=>'Pagos']).'&nbsp'.
                            Html::a('', ['view', 'id'=>$data->id_auxilio], ['class' => 'glyphicon glyphicon-eye-open', 'title'=>'View']).'&nbsp'.
                            Html::a('', ['update', 'id'=>$data->id_auxilio, 'tipo' => $data->tipo], ['class' => 'act glyphicon glyphicon-pencil', 'title'=>'Edit']).'&nbsp'.
                            Html::a('', ['delete', 'id' => $data->id_auxilio], ['class' => 'act glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => '¿Está seguro que desea borrar este auxilio?',
                                'method' => 'post',
                            ],
                            'title'=>'Trash',
                        ]);
                },
                'format' => 'raw',
                'options'=>['width'=>'8%'],   
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
