<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvanceProceso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avance-proceso-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'options' => ['enctype' => 'multipart/form-data',  'name' => 'formulario1']]); ?>

    <?= $form->field($model, 'id_proceso')->hiddenInput(['value'=>$id_p])->label('') ?>


    <!-- <?= $form->field($model, 'fecha')->textInput() ?> -->

    <!-- <?= $form->field($model, 'hora')->textInput() ?> -->

    <?= $form->field($model, 'avance')->textArea(['maxlength' => 1000])->label('Comentario') ?>

    <div class="form-group field-avanceproceso-archivo">
        <div class="form-group field-avanceproceso-archivo">
            <label for="avanceproceso-archivo" class="control-label col-sm-3">Archivo de avance</label>
            <div class="col-sm-6">
                <input id="input-1" name="UploadForm[file]" type="file" class="file filestyle" data-buttonName="btn-primary" data-buttonText="Examinar" style="display: initial;">
            </div>            
        </div>
    </div><br>


    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#id_proceso').attr('value', '<?=$id_p;?>');
        $('#folder').attr('value', 'avances');
    });
</script>