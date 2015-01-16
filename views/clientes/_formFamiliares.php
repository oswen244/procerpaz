<script type="text/javascript">
    $(document).ready(function() {
        $('#familiares-tipo_id').val('<?= $familiar->tipo_id;?>')
        $('#familiares-genero').val('<?= $familiar->genero;?>')
        $('#familiares-id_parentezco').val('<?= $familiar->id_parentezco;?>')
        $('#familiares-fecha_nacimiento').val('<?= $familiar->fecha_nacimiento;?>')
    });
</script>
<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use app\models\Clientes;

/* @var $this yii\web\View */
/* @var $familiar app\familiars\Familiares */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="familiares-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($familiar, 'nombres')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'apellidos')->textInput(['maxlength' => 45]) ?>

    <div class="form-group field-familiares-id_parentezco required">
        <label for="familiares-id_parentezco" class="control-label col-sm-3">Parentezco</label>
        <div class="col-sm-6">
            <select name="Familiares[id_parentezco]" id="familiares-id_parentezco" class="form-control">
                <option value=""></option>
                <?php foreach($parentezcos as $row){?>
                    <option value="<?= $row['id_parentezco'];?>"><?= $row['parentezco'];?></option>
                <?php }?>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

    <!-- <?= $form->field($familiar, 'id_parentezco')->textInput() ?> -->

    <div class="form-group field-familiares-tipo_id required">
        <label for="familiares-tipo_id" class="control-label col-sm-3">Tipo de ID</label>
        <div class="col-sm-6">
            <select name="Familiares[tipo_id]" id="familiares-tipo_id" class="form-control">
                <option value=""></option>
                <option value="<?=Clientes::CEDULA?>"><?=Clientes::CEDULA?></option>
                <option value="<?=Clientes::TI?>"><?=Clientes::TI?></option>
                <option value="<?=Clientes::PASAPORTE?>"><?=Clientes::PASAPORTE?></option>
                <option value="<?=Clientes::RUT?>"><?=Clientes::RUT?></option>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

    <!-- <?= $form->field($familiar, 'tipo_id')->textInput(['maxlength' => 45]) ?> -->

    <?= $form->field($familiar, 'num_id')->textInput(['maxlength' => 45]) ?>

    <div class="form-group field-familiares-genero required">
        <label for="familiares-genero" class="control-label col-sm-3">Sexo</label>
        <div class="col-sm-6">
            <select name="Familiares[genero]" id="familiares-genero" class="form-control">
                <option value=""></option>
                <option value="<?=Clientes::MASCULINO?>"><?=Clientes::MASCULINO?></option>
                <option value="<?=Clientes::FEMENINO?>"><?=Clientes::FEMENINO?></option>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

    <!-- <?= $form->field($familiar, 'genero')->textInput(['maxlength' => 1]) ?> -->

    <div class="form-group field-familiares-fecha_nacimiento">
        <div class="form-group field-familiares-fecha_nacimiento">
            <label for="familiares-fecha_nacimiento" class="control-label col-sm-3">Fecha de nacimiento</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "familiares-fecha_nacimiento", "name" => "Familiares[fecha_nacimiento]", "dateFormat" => "yyyy-MM-dd", 'options' => ['class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
            </div>            
        </div>
    </div>

    <!-- <?= $form->field($familiar, 'fecha_nacimiento')->textInput() ?> -->

    <?= $form->field($familiar, 'pais')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'ciudad')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'email')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'direccion')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'telefono')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'celular')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($familiar, 'id_cliente')->hiddenInput(['value' => $id_cliente])->label('') ?>


    <div class="text-center">
        <?= Html::submitButton($familiar->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $familiar->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
