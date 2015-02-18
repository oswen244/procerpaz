<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvanceProceso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avance-proceso-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'id_proceso')->hiddenInput(['value'=>$id_p])->label('') ?>

    <div class="form-group field-avanceproceso-fecha">
        <div class="form-group field-avanceproceso-fecha">
            <label for="avanceproceso-fecha" class="control-label col-sm-3">Fecha del avance *</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "avanceproceso-fecha", "name" => "AvanceProceso[fecha]", "dateFormat" => "yyyy-MM-dd", 'options' => ['required'=>'', 'value'=>$model->fecha, 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
            </div>            
        </div>
    </div>

    <!-- <?= $form->field($model, 'fecha')->textInput() ?> -->

    <!-- <?= $form->field($model, 'hora')->textInput() ?> -->

    <?= $form->field($model, 'avance')->textArea(['maxlength' => 1000])->label('Avance *') ?>
    
    <div class="form-group text-center">
        <a id="arch_cas" href="#">Agregar archivo</a>
    </div><br>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div id="archivoModal" class="modal fade bs-example-modal-sm act" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Subir archivo al avance</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                   <?=$this->render('upcasos',[
                   ]);  ?>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#arch_cas').on('click', function(event) {
            event.preventDefault();
            $('#archivoModal').modal({backdrop:'static'});
        });    
    });
</script>