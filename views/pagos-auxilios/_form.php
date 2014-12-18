<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagosAuxilios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagos-auxilios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'monto')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'id_auxilio')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
