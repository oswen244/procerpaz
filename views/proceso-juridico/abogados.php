<?php

use yii\helpers\Html;
use app\models\ProcesoJuridico;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PromotoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Abogados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="abogados-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => ['class' => 'text-center'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_usuario',
            'nombres',
            'apellidos',
            // 'telefono',
            // 'email:email',
            // 'celular',
            [
                'attribute'=>'estado',
                'value'=> function($model){
                   if($model->estado === 1){return ProcesoJuridico::SASIS;}else{return ProcesoJuridico::ASIS;}
                }
            ],
            // 'estado',

            // [
            //     'class' => '\kartik\grid\ActionColumn',
            //     'template'=> Html::a('', ['create'], ['class' => 'glyphicon glyphicon-arrow-right', 'title'=>'Asignar caso']),
            // ],

            [
                'label' => 'Asignar caso', 
                'vAlign' => 'middle',
                'value' =>  function($model){
                    return  Html::a('', ['create','id'=>$model->id_usuario], ['class' => 'glyphicon glyphicon-arrow-right', 'title'=>'Asignar caso']);
                },
                'format' => 'raw',
                'width'=>'2%',
            ],
        ],
        'toolbar' => [
            
        ],
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-user"></i>  Abogados',
        ],
    ]); ?>

</div>