<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AvanceProceso */

$this->title = 'Avance N° '.$model->id_avance;
$this->params['breadcrumbs'][] = ['label' => 'Avance Procesos', 'url' => ['index?id_p='.$id_p]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avance-proceso-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_avance], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id_avance], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que desea borrar este avance?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_avance',
            // 'id_proceso',
            'fecha',
            'hora',
            'avance',
        ],
    ]) ?>

</div>
