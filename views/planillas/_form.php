<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Planillas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planillas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'lugar')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'unidad')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'comision_afiliado')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'por_ant_com')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
