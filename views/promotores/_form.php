<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Promotores */
/* @var $form yii\widgets\ActiveForm */
?>
 <div class="text-center">(*) campos requeridos.</div><br>
<div class="promotores-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => 45])->label('Nombres *') ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => 45])->label('Apellidos *') ?>

    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
