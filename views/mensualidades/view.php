<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mensualidades */

$this->title = $model->id_mensualidad;
$this->params['breadcrumbs'][] = ['label' => 'Mensualidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
            <li><?= Html::a('Listar mensualidades', ['index', 'id' => $id_cliente], ['class' => '']) ?></li>
            <li><?= Html::a('Regresar a información de cliente', ['clientes/view', 'id' => $id_cliente], ['class' => '']) ?></li>
            <li><a href="index">Listar clientes</a></li>
            <br>
            <li><?= Html::a('Eliminar pago', ['delete', 'id' => $model->id_mensualidad], [
                'class' => '',
                'data' => [
                    'confirm' => 'Está seguro que desea eliminar este pago?',
                    'method' => 'post',
                ],
                ]) ?>
            </li>
        </ul>
    </div>
    <div class="mensualidades-view col-md-9">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id_mensualidad',
                'fecha_pago',
                // 'monto',
                [
                    'attribute' => 'monto',
                    'value' => "$ ".number_format($model->monto,0)
                 ],
                'total_cuotas',
                // 'id_cliente',
            ],
        ]) ?>

    </div>
</div>
