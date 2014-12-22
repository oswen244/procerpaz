<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'cargo')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'pais')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'genero')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'celular')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'usuario')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'contrasena')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'perfil')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
