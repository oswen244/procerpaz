<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PlanillasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Planillas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planillas-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'text-center'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_planilla',
            'fecha',
            'lugar',
            'unidad',
            // 'comision_afiliado',
            // 'por_ant_com',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'toolbar' => [
            ['content'=>
                Html::a('Crear planilla', ['create'], ['class' => 'btn btn-success'])
            ],
            '{export}',
            // '{toggleData}',
        ],
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-file"></i>  Planilas',
        ],
    ]); ?>

</div>
