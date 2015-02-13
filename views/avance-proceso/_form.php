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
            <label for="avanceproceso-fecha" class="control-label col-sm-3">Fecha del avance</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "avanceproceso-fecha", "name" => "AvanceProceso[fecha]", "dateFormat" => "yyyy-MM-dd", 'options' => ['value'=>$model->fecha, 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
            </div>            
        </div>
    </div>

    <!-- <?= $form->field($model, 'fecha')->textInput() ?> -->

    <!-- <?= $form->field($model, 'hora')->textInput() ?> -->

    <?= $form->field($model, 'avance')->textArea(['maxlength' => 1000]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
