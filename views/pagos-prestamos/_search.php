<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagosPrestamosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagos-prestamos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_pagos') ?>

    <?= $form->field($model, 'capital') ?>

    <?= $form->field($model, 'amortizacion') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'id_prestamo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
