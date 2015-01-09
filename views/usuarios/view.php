<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = $model->nombres.' '.$model->apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
     <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li>
            <?= Html::a('Regresar', ['index'], ['class' => '']) ?>
           </li>
           <li>
            <?= Html::a('Actualizar', ['update', 'id' => $model->id_usuario], ['class' => '']) ?>
           </li>
           <li>
            <?= Html::a('Asignar permisos', ['#'], ['class' => '']) ?>
           </li><br>
           <li>
            <?= Html::a('Eliminar', ['delete', 'id' => $model->id_usuario], [
                'class' => '',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
           </li>
        </ul>
    </div>
    <div class="usuarios-view col-md-9">

        <h1><?= Html::encode($this->title) ?></h1><br>


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id_usuario',
                'nombres',
                'apellidos',
                'cargo',
                'telefono',
                'email:email',
                'pais',
                'ciudad',
                'genero',
                'celular',
                'usuario',
                // 'contrasena',
                // 'perfil',
                // 'estado',
            ],
        ]) ?>

    </div>
</div>
