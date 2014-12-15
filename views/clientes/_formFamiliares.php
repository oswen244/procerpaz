<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $familiar app\familiars\Familiares */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="familiares-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($familiar, 'nombres')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'apellidos')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'tipo_id')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'num_id')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'genero')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($familiar, 'fecha_nacimiento')->textInput() ?>

    <?= $form->field($familiar, 'pais')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'ciudad')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'email')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'direccion')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'telefono')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'parentezco')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'id_cliente')->textInput() ?>

    <?= $form->field($familiar, 'id_parentezco')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($familiar->isNewRecord ? 'Create' : 'Update', ['class' => $familiar->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
