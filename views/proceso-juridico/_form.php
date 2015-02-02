<script type="text/javascript">
    $(document).ready(function() {
        nombreCliente('#doc','#procesojuridico-id_cliente', '#clienteName');
    });
</script>
<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProcesoJuridico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proceso-juridico-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <div class="form-group field-procesojuridico-id">
        <label class="control-label col-sm-3">N° de identificación del cliente</label>
        <div class="col-sm-6">                
            <input id="doc" type="text" required class="form-control">
        </div>
    </div>

    <div class="row text-center">
        <h3 id="clienteName"></h3>
    </div>

    <?= $form->field($model, 'id_cliente')->hiddenInput()->label('') ?>

    <div class="form-group field-procesojuridico-id_abogado required">
        <label for="procesojuridico-id_abogado" class="control-label col-sm-3">Abogados</label>
        <div class="col-sm-6">
            <select name="ProcesoJuridico[id_abogado]" id="procesojuridico-id_abogado" class="form-control">
                <option value=""></option>
                <?php foreach($abogados as $row){?>
                    <option value="<?= $row['id_usuario'];?>"><?= $row['nombres']." ".$row['apellidos'];?></option>
                <?php }?>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

    <!-- <?= $form->field($model, 'id_abogado')->textInput() ?> -->

    <div class="form-group field-procesojuridico-id_estado required">
        <label for="procesojuridico-id_estado" class="control-label col-sm-3">Estado del caso</label>
        <div class="col-sm-6">
            <select name="ProcesoJuridico[id_estado]" id="procesojuridico-id_estado" class="form-control">
                <option value=""></option>
                <?php foreach($estados as $row){?>
                    <option value="<?= $row['id_estado'];?>"><?= $row['nombre'];?></option>
                <?php }?>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

    <!-- <?= $form->field($model, 'id_estado')->textInput() ?> -->

    <div class="form-group field-procesojuridico-fecha">
        <div class="form-group field-procesojuridico-fecha">
            <label for="procesojuridico-fecha" class="control-label col-sm-3">Fecha</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "procesojuridico-fecha", "name" => "ProcesoJuridico[fecha]", "dateFormat" => "yyyy-MM-dd", 'options' => ['value'=>$model->fecha, 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
            </div>            
        </div>
    </div>

    <!-- <?= $form->field($model, 'fecha')->textInput() ?> -->

    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
