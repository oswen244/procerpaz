<script type="text/javascript">
    $(document).ready(function() {
        $('#planillas-fecha').val('<?=$model->fecha;?>');
    });
</script>
<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Planillas */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="text-center">(*) campos requeridos.</div><br>
<div class="planillas-form">
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'numero')->textInput()->label('Número de planilla *') ?>

     <div class="form-group field-clientes-fecha_afiliacion">
        <div class="form-group field-clientes-fecha_afiliacion">
            <label for="clientes-fecha_afiliacion" class="control-label col-sm-3">Fecha *</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "planillas-fecha", "name" => "Planillas[fecha]", "dateFormat" => "yyyy-MM-dd", 'options' => ['required' => '', 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
            </div>            
        </div>
    </div>
    

    <!-- <?= $form->field($model, 'fecha')->textInput() ?> -->

    <?= $form->field($model, 'lugar')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'unidad')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'comision_afiliado')->textInput(['maxlength' => 45])->label('Conmisión por afiliado *') ?>

    <?= $form->field($model, 'por_ant_com')->textInput(['maxlength' => 45])->label('% anticipo por comisión *') ?>


    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
