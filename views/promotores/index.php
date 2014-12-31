<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PromotoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promotores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotores-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'text-center'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_promotor',
            'nombres',
            'apellidos',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'toolbar' => [
            ['content'=>
                Html::a('Registrar Promotor', ['create'], ['class' => 'btn btn-success'])
            ],
            '{export}',
            // '{toggleData}',
        ],
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-user"></i>  Promotores',
        ],
    ]); ?>

</div>
