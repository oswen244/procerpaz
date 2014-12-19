<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagosAuxilios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagos-auxilios-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
	
	<?php if($model->isNewRecord){ ?>
    	<?= $form->field($model, 'monto')->textInput(['maxlength' => 10, 'value'=>$cuota]) ?>
	<?php }else{ ?>
    	<?= $form->field($model, 'monto')->textInput(['maxlength' => 10]) ?>
	<?php } ?>
    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'id_auxilio')->hiddenInput(['value'=>$id_auxilio])->label('') ?>

    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
