<?php

use yii\helpers\Html;
// use yii\grid\GridView
use kartik\grid\GridView;;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GastosPlanillasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gastos Planillas';
$this->params['breadcrumbs'][] = ['label' => 'Planilla', 'url' => ['planillas/view?id='.$id_planilla]];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="col-md-12">
     <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Regresar', ['planillas/view', 'id' => $id_planilla], ['class' => '']) ?></li>
        </ul>
    </div>
    <div class="gastos-planillas-index col-md-9">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => ['class' => 'text-center'],
            'columns' => [

                // 'id_gastos_planillas',
                // 'valor',
                [
                    'attribute' => 'valor',
                    'value' => function($data){ return "$".number_format($data->valor,0);}
                ],
                'fuente',
                'asumido_por',
                'Detalle',
                // 'id_planilla',

                // ['class' => 'yii\grid\ActionColumn'],

                [
                    'label' => '', 
                    'vAlign' => 'middle',
                    'value' =>  function($data){
                        return  Html::a('', ['update', 'id'=>$data->id_gastos_planillas, 'id_planilla'=>$data->id_planilla], ['class' => 'act glyphicon glyphicon-pencil', 'title'=>'Editar']).'&nbsp'.
                                Html::a('', ['delete', 'id' => $data->id_gastos_planillas], ['class' => 'act glyphicon glyphicon-trash',
                                'data' => [
                                    'confirm' => '¿Está seguro que desea borrar este gasto?',
                                    'method' => 'post',
                                ],
                                'title'=>'Eliminar',

                            ]);
                    },
                    'format' => 'raw',
                    'options'=>['width'=>'7%'],
                ],
            ],
            'toolbar' => [
                ['content'=>
                    Html::a('Agregar gasto', ['create', 'id_planilla'=>$id_planilla], ['class' => 'btn btn-success'])
                ],
                '{export}',
                // '{toggleData}',
            ],
            'hover' => true,
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => '<i class="glyphicon glyphicon-usd"></i>  Gastos',
            ],
        ]); ?>

    </div>
</div>
