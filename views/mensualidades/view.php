<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mensualidades */

$this->title = $model->id_mensualidad;
$this->params['breadcrumbs'][] = ['label' => 'Mensualidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensualidades-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_mensualidad], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_mensualidad], [
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
            'id_mensualidad',
            'fecha_pago',
            'monto',
            'total_cuotas',
            'id_cliente',
        ],
    ]) ?>

</div>
