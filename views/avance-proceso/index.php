<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvanceProcesoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Avance Procesos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-center"><?= Html::tag('h3', isset($_GET['m']) ? $_GET['m'] : '' ,['class'=> 'help-block']);?></div>
<div class="col-md-12">
     <div class="col-md-2">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Regresar', ['proceso-juridico/index'], ['class' => '']) ?></li>
        </ul>
    </div>
    <div class="avance-proceso-index col-md-10">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => ['class' => 'text-center'],
            'columns' => [

                // 'id_avance',
                // 'id_proceso',
                'fecha',
                'hora',
                'usuario',
                'avance',
                // 'archivo',
                [
                    'attribute'=>'archivo',
                    'value'=>function($model){
                        return Html::a($model->archivo, Yii::$app->request->baseUrl.'/juridico/'.$model->id_proceso.'/avances/'.$model->archivo, ['title'=>'Descargar archivo', 'download'=>$model->archivo]);
                    },
                    'format'=>'raw',
                ],

                // ['class' => 'yii\grid\ActionColumn'],

                [
                'label' => 'Acciones', 
                'vAlign' => 'middle',
                'value' =>  function($model){
                    return  Html::a('', ['view', 'id'=>$model->id_avance, 'id_p'=>$model->id_proceso], ['class' => 'glyphicon glyphicon-eye-open', 'title'=>'Ver']).'&nbsp'.
                            Html::a('', ['update', 'id'=>$model->id_avance,  'id_p'=>$model->id_proceso], ['class' => 'glyphicon glyphicon-pencil', 'title'=>'Actualizar']).'&nbsp'.
                            Html::a('', ['delete', 'id'=>$model->id_avance,  'id_p' => $model->id_proceso], ['class' => 'glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => '¿Está seguro que desea borrar este avance?',
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
                   Html::a('Agregar un avance', ['create', 'id_proceso'=>$id_proceso], ['class' => 'btn btn-success']),
                ],
            ],
            'hover' => true,
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => '<i class="glyphicon glyphicon-folder-open"></i> Avances del proceso',
            ],
        ]); ?>

    </div>
</div>
