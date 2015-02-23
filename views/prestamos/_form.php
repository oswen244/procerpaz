<script type="text/javascript">
    $(document).ready(function() {
        nombreCliente('#doc','#prestamos-id_cliente', '#clienteName');
        $('#prestamos-fecha_prest').val('<?=$model->fecha_prest;?>');
        $('#prestamos-fecha_rep').val('<?=$model->fecha_rep;?>');
        $('#prestamos-id_estado').val('<?=$model->id_estado;?>');
    });
</script>
<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prestamos */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="text-center">(*) campos requeridos.</div><br>
<div class="prestamos-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <div class="form-group field-auxilios-monto">
        <label class="control-label col-sm-3">N° de identificación *</label>
        <div class="col-sm-6">                
            <input id="doc" type="text" required class="form-control">
        </div>
    </div>
    <?= $form->field($model, 'id_cliente')->hiddenInput()->label('') ?>

    <div class="row text-center">
        <h3 id="clienteName"></h3>
    </div>


    <?= $form->field($model, 'monto')->textInput(['required' => '', 'maxlength' => 10])->label('Monto *') ?>

    <?= $form->field($model, 'interes_mensual')->textInput(['required' => ''])->label('interes mensual *') ?>

    <?= $form->field($model, 'num_cuotas')->textInput(['required' => ''])->label('Número de cuotas *') ?>

    <?= $form->field($model, 'valor_cuota')->textInput(['maxlength' => 10])->label('Valor cuota') ?>

    <div class="form-group field-prestamos-fecha_prest">
        <div class="form-group field-prestamos-fecha_prest">
            <label for="prestamos-fecha_prest" class="control-label col-sm-3">Fecha de prestamo *</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "prestamos-fecha_prest", "name" => "Prestamos[fecha_prest]", "dateFormat" => "yyyy-MM-dd", 'options' => ['required' => '', 'value'=>$model->fecha_prest, 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"]])?>
            </div>            
        </div>
    </div>

    <!-- <?= $form->field($model, 'fecha_prest')->textInput() ?> -->

    <div class="form-group field-prestamos-fecha_rep">
        <div class="form-group field-prestamos-fecha_rep">
            <label for="prestamos-fecha_rep" class="control-label col-sm-3">Fecha de reporte</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "prestamos-fecha_rep", "name" => "Prestamos[fecha_rep]", "dateFormat" => "yyyy-MM-dd", 'options' => ['value'=>$model->fecha_rep, 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"]])?>
            </div>            
        </div>
    </div>

    <!-- <?= $form->field($model, 'fecha_rep')->textInput() ?> -->

    
    <div class="form-group field-prestamos-id_estado required">
        <label for="prestamos-id_estado" class="control-label col-sm-3">Estado *</label>
        <div class="col-sm-6">
            <select name="Prestamos[id_estado]" id="prestamos-id_estado" class="form-control">
                <option value=""></option>
                <?php foreach($estados as $row){?>
                    <option value="<?= $row['id_estado'];?>"><?= $row['nombre'];?></option>
                <?php }?>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>
    <!-- <?= $form->field($model, 'id_estado')->textInput() ?> -->

    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
