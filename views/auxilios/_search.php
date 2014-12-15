<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuxiliosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auxilios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_auxilio') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'porcentaje_aux') ?>

    <?= $form->field($model, 'monto') ?>

    <?= $form->field($model, 'num_meses') ?>

    <?php // echo $form->field($model, 'fecha_auxilio') ?>

    <?php // echo $form->field($model, 'proveedor') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'id_cliente') ?>

    <?php // echo $form->field($model, 'tipo_auxilio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
