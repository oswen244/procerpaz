<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mensualidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensualidades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_pago')->textInput() ?>

    <?= $form->field($model, 'monto')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'total_cuotas')->textInput() ?>

	<?php if($model->isNewRecord){ ?>
    	<?= $form->field($model, 'id_cliente')->hiddenInput(['value'=>$id_cliente])->label('') ?>
	<?php }else{ ?>
    	<?= $form->field($model, 'id_cliente')->textInput() ?>
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Agregar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
