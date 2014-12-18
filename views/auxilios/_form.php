<script type="text/javascript">
    $(document).ready(function() {
        $('#fam').val('<?=$model->familiar;?>');
    });
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

        <div class="form-group field-auxilios-monto">
            <label class="control-label col-sm-3">N° de identificación</label>
            <div class="col-sm-6">                
                <input id="cedula" type="text" value="" class="form-control">
            </div>
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
            </div
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
