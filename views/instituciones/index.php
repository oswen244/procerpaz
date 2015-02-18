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
<div class="text-center"><?= Html::tag('h3', (isset($_GET['m'])) ? $_GET['m'] : '' ,['class'=> 'help-block']);?></div>
<div class="instituciones-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'text-center'],
        'columns' => [

            // 'id_institucion',
            'nombre',
            'descripcion',

            ['class' => '\yii\grid\ActionColumn'],
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
