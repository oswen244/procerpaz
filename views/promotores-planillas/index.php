<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PromotoresPlanillasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promotores Planillas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotores-planillas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Promotores Planillas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_promotores_planillas',
            'id_promotor',
            'id_planilla',
            'gastos_promotor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
