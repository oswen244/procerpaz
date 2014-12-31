<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Planillas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planillas-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

     <div class="form-group field-clientes-fecha_afiliacion">
        <div class="form-group field-clientes-fecha_afiliacion">
            <label for="clientes-fecha_afiliacion" class="control-label col-sm-3">Fecha</label>
            <div class="col-sm-6">
                <?= yii\jui\DatePicker::widget(["id" => "planillas-fecha", "name" => "Planillas[fecha]", "dateFormat" => "yyyy-MM-dd", 'options' => ['required' => '', 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"]])?>
            </div>            
        </div>
    </div>


    <!-- <?= $form->field($model, 'fecha')->textInput() ?> -->

    <?= $form->field($model, 'lugar')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'unidad')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'comision_afiliado')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'por_ant_com')->textInput(['maxlength' => 45]) ?>

    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
