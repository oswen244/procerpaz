<script type="text/javascript">
    $(document).ready(function() {
        $('#cedula').on('blur', function(event) {
            event.preventDefault();
            famLista($('#cedula').val());
        });
    });

    function famLista(num_id){
        var num = num_id;
        $.post('familiares', {data: num}).done(function(data) {
            reloadSelect(data,'#fam')
        });
    }

    function reloadSelect(data, idSelect){
        var x = [];
        $(idSelect).empty();
        $(idSelect).append('<option value="">Seleccione un familiar</option>');
        $.each(data, function(index, element) {
            var p = new Array();
            $.each(element, function(i, e) {
                p.push(e);
            });
            var fam = p[0]+"_"+p[1];
            $(idSelect).append('<option value='+fam+'>'+p[0]+" "+p[1]+'</option>');
        });
    }
</script>
<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Auxilios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auxilios-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <div class="col-md-12">
        <div class="col-md-6">
            <strong>N° Documento de identificación</strong>
            <input id="cedula" type="text" class="form-control">
        </div>
        <div class="col-md-6">
            <strong>Familiares</strong>
            <select name="Auxilios[familiar]" id="fam" class="form-control">
                <option value=""></option>
            </select>
        </div>        
    </div>


    <?= $form->field($model, 'tipo')->hiddenInput(['value'=>$tipo])->label('') ?>
    <?php if($tipo === '1'){ ?>
        <?= $form->field($model, 'porcentaje_aux')->textInput() ?>
    <?php } ?>
    <?= $form->field($model, 'monto')->textInput(['maxlength' => 10]) ?>
    <?php if($tipo === '1'){ ?>
        <?= $form->field($model, 'num_meses')->textInput() ?>
    <?php } ?>
    <?= $form->field($model, 'fecha_auxilio')->textInput() ?>
    <?php if($tipo === '2'){ ?>
        <?= $form->field($model, 'proveedor')->textInput(['maxlength' => 45]) ?>
    <?php } ?>
    <?php if($tipo === '1'){ ?>
        <?= $form->field($model, 'estado')->textInput() ?>
    <?php } ?>
    <?= $form->field($model, 'id_cliente')->textInput() ?>

    <?= $form->field($model, 'tipo_auxilio')->textInput() ?>

    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
