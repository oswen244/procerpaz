<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use app\models\GastosPlanillas;

/* @var $this yii\web\View */
/* @var $model app\models\GastosPlanillas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-planillas-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'valor')->textInput(['maxlength' => 10]) ?>

    <div class="form-group field-gastosplanillas-fuente required">
        <label for="gastosplanillas-fuente" class="control-label col-sm-3">Fuente a descontar</label>
        <div class="col-sm-6">
            <select name="GastosPlanillas[fuente]" id="gastosplanillas-fuente" class="form-control">
                <option value=""></option>
                <option value="<?=GastosPlanillas::TOTAL_PLANILLA?>"><?=GastosPlanillas::TOTAL_PLANILLA?></option>
                <option value="<?=GastosPlanillas::POR_AFILIACION?>"><?=GastosPlanillas::POR_AFILIACION?></option>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

   <!-- <?= $form->field($model, 'fuente')->textInput() ?> -->

    <div class="form-group field-gastosplanillas-asumido_por required">
        <label for="gastosplanillas-asumido_por" class="control-label col-sm-3">Asumido por</label>
        <div class="col-sm-6">
            <select name="GastosPlanillas[asumido_por]" id="gastosplanillas-asumido_por" class="form-control">
                <option value=""></option>
                <option value="<?=GastosPlanillas::PROMOTORES?>"><?=GastosPlanillas::PROMOTORES?></option>
                <option value="<?=GastosPlanillas::FUNDACION?>"><?=GastosPlanillas::FUNDACION?></option>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

    <!-- <?= $form->field($model, 'asumido_por')->textInput() ?> -->

    <?= $form->field($model, 'Detalle')->textArea(['maxlength' => 1000]) ?>

    <?= $form->field($model, 'id_planilla')->hiddenInput()->label('') ?>

    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#gastosplanillas-id_planilla').val('<?=$id_planilla;?>');
        $('#gastosplanillas-fuente').val('<?=$model->fuente;?>');
        $('#gastosplanillas-asumido_por').val('<?=$model->asumido_por;?>');
    });
</script>