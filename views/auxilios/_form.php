<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Auxilios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auxilios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo')->textInput() ?>

    <?= $form->field($model, 'porcentaje_aux')->textInput() ?>

    <?= $form->field($model, 'monto')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'num_meses')->textInput() ?>

    <?= $form->field($model, 'fecha_auxilio')->textInput() ?>

    <?= $form->field($model, 'proveedor')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'id_cliente')->textInput() ?>

    <?= $form->field($model, 'tipo_auxilio')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
