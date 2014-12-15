<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrestamosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestamos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_prestamo') ?>

    <?= $form->field($model, 'monto') ?>

    <?= $form->field($model, 'interes_mensual') ?>

    <?= $form->field($model, 'num_cuotas') ?>

    <?= $form->field($model, 'valor_cuota') ?>

    <?php // echo $form->field($model, 'cuotas_pagadas') ?>

    <?php // echo $form->field($model, 'fecha_prest') ?>

    <?php // echo $form->field($model, 'fecha_rep') ?>

    <?php // echo $form->field($model, 'id_cliente') ?>

    <?php // echo $form->field($model, 'id_estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
