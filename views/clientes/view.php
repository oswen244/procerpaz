<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */

$this->title = $model->nombres." ".$model->apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="col-md-12">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
            <li><?= Html::a('Actualizar información', ['update', 'id' => $model->id_cliente], ['class' => '']) ?></li>
            <li><?= Html::a('Familiares', ['familiares', 'id' => $model->id_cliente], ['class' => '']) ?></li>
            <li><?= Html::a('Mensualidad', ['mensualidades/index', 'id' => $model->id_cliente], ['class' => '']) ?></li>
            <li><a href="">Auxilios</a></li>
            <li><a href="index">Listar clientes</a></li>
            <br>
            <li><?= Html::a('Eliminar cliente', ['delete', 'id' => $model->id_cliente], [
                'class' => '',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
                ]) ?>
            </li>
        </ul>
    </div>
       
    <div class="clientes-view col-md-9">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id_cliente',
                'num_afiliacion',
                'fecha_afiliacion',
                'nombres',
                'apellidos',
                'tipo_id',
                'num_id',
                'genero',
                'lugar_exp',
                'fecha_nacimiento',
                'grado',
                'pais',
                'ciudad',
                'email:email',
                'direccion',
                'telefono',
                'id_institucion',
                'id_planilla',
                'id_estado',
            ],
        ]) ?>

    </div>
</div>
