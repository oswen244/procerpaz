<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FamiliaresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Familiares';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="familiares-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Familiares', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id_familiar',
            'nombres',
            'apellidos',
            'tipo_id',
            'num_id',
            // 'genero',
            // 'fecha_nacimiento',
            // 'pais',
            // 'ciudad',
            // 'email:email',
            // 'direccion',
            // 'telefono',
            // 'parentezco',
            // 'id_cliente',
            // 'id_parentezco',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
