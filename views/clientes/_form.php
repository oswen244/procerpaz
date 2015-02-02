<script type="text/javascript">
    $(document).ready(function() {
        $('#clientes-tipo_id').val('<?= $model->tipo_id;?>')
        $('#clientes-genero').val('<?= $model->genero;?>')
        $('#clientes-id_institucion').val('<?= $model->id_institucion;?>')
        $('#clientes-id_planilla').val('<?= $model->id_planilla;?>')
        $('#clientes-id_planilla').val('<?= $model->id_planilla;?>')
        $('#clientes-id_estado').val('<?= $model->id_estado;?>')
        $('#clientes-fecha_afiliacion').val('<?=$model->fecha_afiliacion?>');
        $('#clientes-fecha_nacimiento').val('<?=$model->fecha_nacimiento?>');
        $('#clientes-fecha_ven').val('<?=$model->fecha_ven?>');
        $('#clientes-fecha_rep').val('<?=$model->fecha_rep?>');
    });
</script>
<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use app\models\Clientes;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']) ?>
    
    <div class="form-group field-clientes-fecha_afiliacion">
        <div class="form-group field-clientes-fecha_afiliacion">
            <label for="clientes-fecha_afiliacion" class="control-label col-sm-3">Fecha de afiliación</label>
            <div class="col-sm-6">
                <?php if($model->isNewRecord){ ?>
                    <?= yii\jui\DatePicker::widget(["id" => "clientes-fecha_afiliacion", "name" => "Clientes[fecha_afiliacion]", "dateFormat" => "yyyy-MM-dd", 'options' => ['required' => '', 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
                <?php }else{ ?>
                    <?= yii\jui\DatePicker::widget(["id" => "clientes-fecha_afiliacion", "name" => "Clientes[fecha_afiliacion]", "dateFormat" => "yyyy-MM-dd", 'options' => ['value'=> $model->fecha_afiliacion, 'required' => '', 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
                <?php } ?>
            </div>            
        </div>
    </div>
    <!-- <?= $form->field($model, 'fecha_afiliacion')->textInput() ?> -->

    <?= $form->field($model, 'num_afiliacion')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => 45]) ?>
    
    <!-- <?= $form->field($model, 'tipo_id')->textInput(['maxlength' => 45]) ?> -->
    
    <div class="form-group field-clientes-tipo_id required">
        <label for="clientes-tipo_id" class="control-label col-sm-3">Tipo de ID</label>
        <div class="col-sm-6">
            <select name="Clientes[tipo_id]" id="clientes-tipo_id" class="form-control">
                <option value=""></option>
                <option value="<?=Clientes::CEDULA?>"><?=Clientes::CEDULA?></option>
                <option value="<?=Clientes::TI?>"><?=Clientes::TI?></option>
                <option value="<?=Clientes::PASAPORTE?>"><?=Clientes::PASAPORTE?></option>
                <option value="<?=Clientes::RUT?>"><?=Clientes::RUT?></option>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>


    <?= $form->field($model, 'num_id')->textInput(['maxlength' => 45]) ?>

    <div class="form-group field-clientes-genero required">
        <label for="clientes-genero" class="control-label col-sm-3">Sexo</label>
        <div class="col-sm-6">
            <select name="Clientes[genero]" id="clientes-genero" class="form-control">
                <option value=""></option>
                <option value="<?=Clientes::MASCULINO?>"><?=Clientes::MASCULINO?></option>
                <option value="<?=Clientes::FEMENINO?>"><?=Clientes::FEMENINO?></option>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

    <!-- <?= $form->field($model, 'genero')->textInput(['maxlength' => 1]) ?> -->

    <?= $form->field($model, 'lugar_exp')->textInput(['maxlength' => 45]) ?>

    <div class="form-group field-clientes-fecha_nacimiento">
        <div class="form-group field-clientes-fecha_nacimiento">
            <label for="clientes-fecha_nacimiento" class="control-label col-sm-3">Fecha de nacimiento</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "clientes-fecha_nacimiento", "name" => "Clientes[fecha_nacimiento]", "dateFormat" => "yyyy-MM-dd", 'options' => ['value'=>$model->fecha_nacimiento, 'class' => 'fecha form-control', "placeholder" => "año-mes-dia ej:1985-05-10"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
            </div>            
        </div>
    </div>

    <!-- <?= $form->field($model, 'fecha_nacimiento')->textInput() ?> -->

    <?= $form->field($model, 'grado')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'pais')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'celular')->textInput(['maxlength' => 45]) ?>

    <div class="form-group field-clientes-id_institucion required">
        <label for="clientes-id_institucion" class="control-label col-sm-3">Institución</label>
        <div class="col-sm-6">
            <select name="Clientes[id_institucion]" id="clientes-id_institucion" class="form-control">
                <option value=""></option>
                <?php foreach($instituciones as $row){?>
                    <option value="<?= $row['id_institucion'];?>"><?= $row['nombre'];?></option>
                <?php }?>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

    <!-- <?= $form->field($model, 'id_institucion')->textInput() ?> -->

    <div class="form-group field-clientes-id_planilla required">
        <label for="clientes-id_planilla" class="control-label col-sm-3">Planilla</label>
        <div class="col-sm-6">
            <select name="Clientes[id_planilla]" id="clientes-id_planilla" class="form-control">
                <option value=""></option>
                <?php foreach($planillas as $row){?>
                    <option value="<?= $row['id_planilla'];?>"><?= $row['id_planilla'];?></option>
                <?php }?>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

    <!-- <?= $form->field($model, 'id_planilla')->textInput() ?> -->
    <?php if($model->isNewRecord){ ?>
        <div class="form-group field-clientes-id_estado required">
            <label for="clientes-id_estado" class="control-label col-sm-3">Estado del cliente</label>
            <div class="col-sm-6">
                <select name="Clientes[id_estado]" id="clientes-id_estado" class="form-control">
                    <option value=""></option>
                    <?php foreach($estados as $row){?>
                        <option value="<?= $row['id_estado'];?>"><?= $row['nombre'];?></option>
                    <?php }?>
                </select>
                <div class="help-block help-block-error "></div>
            </div>
        </div>
    <?php } ?>
    <!-- <?= $form->field($model, 'id_estado')->textInput() ?> -->
    
    <!-- <div class="form-group field-clientes-fecha_rep">
        <div class="form-group field-clientes-fecha_rep">
            <label for="clientes-fecha_rep" class="control-label col-sm-3">Fecha de reporte</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "clientes-fecha_rep", "name" => "Clientes[fecha_rep]", "dateFormat" => "yyyy-MM-dd", 'options' => ['value'=>$model->fecha_rep, 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
            </div>            
        </div>
    </div>
     -->
    <!-- <?= $form->field($model, 'fecha_rep')->textInput() ?> -->

   <!--  <div class="form-group field-clientes-fecha_ven">
        <div class="form-group field-clientes-fecha_ven">
            <label for="clientes-fecha_ven" class="control-label col-sm-3">Fecha de vencimiento</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "clientes-fecha_ven", "name" => "Clientes[fecha_ven]", "dateFormat" => "yyyy-MM-dd", 'options' => ['value'=>$model->fecha_ven, 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
            </div>           
        </div>
    </div> -->

    <!-- <?= $form->field($model, 'fecha_ven')->textInput() ?> -->

    <?= $form->field($model, 'monto_paquete')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'observaciones')->textArea(['maxlength' => 1000]) ?>

    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
