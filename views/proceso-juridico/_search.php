<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProcesoJuridicoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proceso-juridico-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_proceso') ?>

    <?= $form->field($model, 'id_cliente') ?>

    <?= $form->field($model, 'id_abogado') ?>

    <?= $form->field($model, 'tiempo_max') ?>

    <?= $form->field($model, 'id_estado') ?>

    <?php // echo $form->field($model, 'peso_max') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'hora') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
