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

	<?php if($model->isNewRecord) {?>
    	<?= $form->field($model, 'capital')->textInput(['value'=>Html::encode($resto-($cuota['valor_cuota']-$cuota['interes'])), 'maxlength' => 10]) ?>
	<?php }else{ ?>
    	<?= $form->field($model, 'capital')->textInput(['maxlength' => 10]) ?>
    <?php } ?>
	
	<?php if($model->isNewRecord) {?>
    	<?= $form->field($model, 'valor_cuota')->textInput(['value'=>Html::encode($cuota['valor_cuota']), 'maxlength' => 10]) ?>
	<?php }else{ ?>
    	<?= $form->field($model, 'valor_cuota')->textInput(['maxlength' => 10]) ?>
    <?php } ?>

    <div class="form-group field-pagosprestamos-fecha">
        <div class="form-group field-pagosprestamos-fecha">
            <label for="pagosprestamos-fecha" class="control-label col-sm-3">Fecha de pago</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "pagosprestamos-fecha", "name" => "PagosPrestamos[fecha]", "dateFormat" => "yyyy-MM-dd", 'options' => ['value'=>$model->fecha, 'class' => 'fecha form-control', "placeholder" => "año-mes-dia ej:1985-05-10"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
            </div>            
        </div>
    </div>

    <!-- <?= $form->field($model, 'fecha')->textInput() ?> -->
	
	<?php if($model->isNewRecord) {?>
    	<?= $form->field($model, 'interes')->textInput(['value'=>Html::encode(floatval($cuota['interes'])),'maxlength' => 10]) ?>
	<?php }else{ ?>
    	<?= $form->field($model, 'interes')->textInput(['maxlength' => 10]) ?>
    <?php } ?>
	
	<?php if($model->isNewRecord) {?>
   		<?= $form->field($model, 'amortizacion')->textInput(['value'=>Html::encode(floatval($cuota['valor_cuota']-$cuota['interes'])),'maxlength' => 10]) ?>
	<?php }else{ ?>
   		<?= $form->field($model, 'amortizacion')->textInput(['maxlength' => 10]) ?>
    <?php } ?>

    <?= $form->field($model, 'id_prestamo')->hiddenInput(['value' => $id_prestamo])->label('') ?>
    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
