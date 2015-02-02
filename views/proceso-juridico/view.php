<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProcesoJuridico */

$this->title = $model->id_proceso;
$this->params['breadcrumbs'][] = ['label' => 'Proceso Juridicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proceso-juridico-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_proceso], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_proceso], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_proceso',
            'id_cliente',
            'id_abogado',
            'tiempo_max',
            'id_estado',
            'peso_max',
            'fecha',
            'hora',
        ],
    ]) ?>

</div>
