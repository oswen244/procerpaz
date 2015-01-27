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

    <div class="form-group field-pagosauxilios-fecha">
        <div class="form-group field-pagosauxilios-fecha">
            <label for="pagosauxilios-fecha" class="control-label col-sm-3">Fecha de pago</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "pagosauxilios-fecha", "name" => "PagosAuxilios[fecha]", "dateFormat" => "y-MM-d", 'options' => ['class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
            </div>
            <div class="help-block help-block-error "></div>            
        </div>
    </div>
    <!-- <?= $form->field($model, 'fecha')->textInput() ?> -->

    <?= $form->field($model, 'id_auxilio')->hiddenInput(['value'=>$id_auxilio])->label('') ?>

    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
