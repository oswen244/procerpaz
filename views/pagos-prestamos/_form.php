<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagosPrestamos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagos-prestamos-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'capital')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'amortizacion')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'id_prestamo')->hiddenInput(['value' => $model->id_prestamo])->label('') ?>

    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
