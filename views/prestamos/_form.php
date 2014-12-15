<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prestamos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestamos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'monto')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'interes_mensual')->textInput() ?>

    <?= $form->field($model, 'num_cuotas')->textInput() ?>

    <?= $form->field($model, 'valor_cuota')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'fecha_prest')->textInput() ?>

    <?= $form->field($model, 'fecha_rep')->textInput() ?>

    <?= $form->field($model, 'id_cliente')->textInput() ?>

    <?= $form->field($model, 'id_estado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
