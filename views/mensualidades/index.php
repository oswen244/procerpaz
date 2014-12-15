<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MensualidadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mensualidades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensualidades-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mensualidades', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_mensualidad',
            'fecha_pago',
            'monto',
            'total_cuotas',
            'id_cliente',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
