<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use app\models\Auxilios;


/* @var $this yii\web\View */
/* @var $model app\models\Auxilios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auxilios-form">
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

        <div class="form-group field-auxilios-monto">
            <label class="control-label col-sm-3">N° de identificación</label>
            <div class="col-sm-6">                
                <input id="doc" type="text" required value="" class="form-control">
            </div>
        </div>

        <div class="row text-center">
            <h3 id="clienteName"></h3>
        </div>

    <?php if($tipo === '2'){ ?>
        <div class="form-group field-auxilios-monto">
            <label class="control-label col-sm-3">Familiares</label>
            <div class="col-sm-6">
                <select name="Auxilios[familiar]" id="fam" class="form-control">
                    <option value=""></option>
                <?php if(!$model->isNewRecord){ ?>
                    <?php foreach($familiares as $row){?>
                        <option value="<?= $row['nombres']." ".$row['apellidos'];?>"><?= $row['nombres']." ".$row['apellidos'];?></option>
                    <?php }?>
                <?php }?>
                </select>
            </div>
        </div>
    <?php } ?>        
    
    <?= $form->field($model, 'tipo')->hiddenInput(['value'=>$tipo])->label('') ?>
    <?php if($tipo === '1'){ ?>
        <?= $form->field($model, 'porcentaje_aux')->textInput() ?>
    <?php } ?>
    <?= $form->field($model, 'monto')->textInput(['maxlength' => 10]) ?>
    <?php if($tipo === '1'){ ?>
        <?= $form->field($model, 'num_meses')->textInput() ?>
    <?php } ?>

     <div class="form-group field-auxilios-fecha_auxilio">
        <div class="form-group field-auxilios-fecha_auxilio">
            <label for="auxilios-fecha_auxilio" class="control-label col-sm-3">Fecha</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "auxilios-fecha", "name" => "Auxilios[fecha_auxilio]", "dateFormat" => "yyyy-MM-dd", 'options' => ['value'=>$model->fecha_auxilio, 'required' => '', 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"]])?>
            </div>            
        </div>
    </div>
    <!-- <?= $form->field($model, 'fecha_auxilio')->textInput() ?> -->
    <?php if($tipo === '2'){ ?>
        <?= $form->field($model, 'proveedor')->textInput(['maxlength' => 45]) ?>
    <?php } ?>
    <?php if($tipo === '1'){ ?>

        <div class="form-group field-auxilios-estado required">
            <label for="auxilios-estado" class="control-label col-sm-3">Estado</label>
            <div class="col-sm-6">
                <select name="Auxilios[estado]" id="auxilios-estado" class="form-control">
                    <option value=""></option>
                    <option value="<?=Auxilios::EN_CURSO;?>">En curso</option>
                    <option value="<?=Auxilios::TERMINADO;?>">Terminado</option>
                </select>
                <div class="help-block help-block-error "></div>
            </div>
        </div>
        <!-- <?= $form->field($model, 'estado')->textInput() ?> -->
    <?php } ?>
    <?= $form->field($model, 'id_cliente')->hiddenInput()->label('') ?>

    <div class="form-group field-auxilios-tipo_auxilio required">
        <label for="auxilios-tipo_auxilio" class="control-label col-sm-3">Tipo de auxilio</label>
        <div class="col-sm-6">
            <select name="Auxilios[tipo_auxilio]" id="auxilios-tipo_auxilio" required class="form-control">
                <option value=""></option>
                <?php foreach($tipos as $row){?>
                    <option value="<?= $row['id_tipo'];?>"><?= $row['tipo_auxilio'];?></option>
                <?php }?>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

    <!-- <?= $form->field($model, 'tipo_auxilio')->textInput() ?> -->

    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#fam').val('<?=$model->familiar;?>');
        $('#auxilios-fecha').val('<?=$model->fecha_auxilio?>');
        $('#auxilios-tipo_auxilio').val('<?=$model->tipo_auxilio?>');
        $('#auxilios-estado').val('<?=$model->estado?>');
        if(<?=$model->estado?> == <?=Auxilios::EN_CURSO?>)
            $('#auxilios-estado').val('En curso'); //No muestra el dato en el update
        else
            $('#auxilios-estado').val('Terminado');
        $('#doc').on('blur', function(event) {
            $.post('getcliente',{data: $('#doc').val()}).done(function(data) {
                $('#auxilios-id_cliente').val(data['id_cliente']);
                if($('#doc').val() != '')
                    $('#clienteName').text(data['nombres']+' '+data['apellidos']);
            });
        });
    });
</script>