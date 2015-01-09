<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'text-center'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_usuario',
            'nombres',
            'apellidos',
            'cargo',
            'telefono',
            // 'email:email',
            // 'pais',
            'ciudad',
            // 'genero',
            // 'celular',
            // 'usuario',
            // 'contrasena',
            'perfil',
            // 'estado',

            ['class' => '\yii\grid\ActionColumn'],
        ],
        'toolbar' => [
            ['content'=>
                Html::a('Crear usuario', ['create'], ['class' => 'btn btn-success'])
            ],
            '{export}',
        ],
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-user"></i>  Usuarios',
        ],
    ]); ?>

</div>
