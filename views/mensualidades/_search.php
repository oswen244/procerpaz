<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MensualidadesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensualidades-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_mensualidad') ?>

    <?= $form->field($model, 'fecha_pago') ?>

    <?= $form->field($model, 'monto') ?>

    <?= $form->field($model, 'total_cuotas') ?>

    <?= $form->field($model, 'id_cliente') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
