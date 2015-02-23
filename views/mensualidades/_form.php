<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mensualidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensualidades-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <div class="form-group field-mensualidades-fecha_pago">
        <div class="form-group field-mensualidades-fecha_pago">
            <label for="mensualidades-fecha_pago" class="control-label col-sm-3">Fecha de pago</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "mensualidades-fecha_pago", "name" => "Mensualidades[fecha_pago]", "dateFormat" => "y-MM-d", 'options' => ['class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
            </div>            
        </div>
    </div>

    <!-- <?= $form->field($model, 'fecha_pago')->textInput() ?> -->

    <?= $form->field($model, 'monto')->textInput(['maxlength' => 10]) ?>

    <!-- <?= $form->field($model, 'total_cuotas')->textInput() ?> -->

	<?php if($model->isNewRecord){ ?>
    	<?= $form->field($model, 'id_cliente')->hiddenInput(['value'=>$id_cliente])->label('') ?>
	<?php }else{ ?>
    	<?= $form->field($model, 'id_cliente')->textInput() ?>
    <?php } ?>
    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Agregar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
