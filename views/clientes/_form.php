<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'num_afiliacion')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'fecha_afiliacion')->textInput() ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'tipo_id')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'num_id')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'genero')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'lugar_exp')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput() ?>

    <?= $form->field($model, 'grado')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'pais')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'id_institucion')->textInput() ?>

    <?= $form->field($model, 'id_planilla')->textInput() ?>

    <?= $form->field($model, 'id_estado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
