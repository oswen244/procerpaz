<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InstitucionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instituciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instituciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'text-center'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_institucion',
            'nombre',
            'descripcion',

            ['class' => '\kartik\grid\ActionColumn'],
        ],
        'toolbar' => [
            ['content'=>
                Html::a('Crear insitución', ['create'], ['class' => 'btn btn-success']),
                // Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Agregar institución', 'class'=>'btn btn-success', 'onclick'=>'']) 
            ],
            '{export}',
        ],
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-home"></i>  Instituciones',
        ],
    ]); ?>

</div>
