<?php  
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<div class="col-md-12">
	 <div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	       <li><?= Html::a('Regresar', ['index'], ['class' => '']) ?></li>
	    </ul>
	</div>
	<div class="col-md-9">

	    <h1>Configuración</h1><br>

		<?php $form = ActiveForm::begin(['action' => 'guardar-config', 'layout' => 'horizontal']); ?>


				<!-- <?= $form->field($model, 'tiempo_max')->textInput()->label('Tiempo máximo de modificación') ?> -->

				<div class="form-group field-procesojuridico-tiempo_max">
					<label class="control-label col-sm-3" for="procesojuridico-tiempo_max">Tiempo máximo de modificación (MIN)</label>
					<div class="col-sm-6">
						<input type="text" id="procesojuridico-tiempo_max" class="form-control" name="tiempo_max" value="<?=$model->tiempo_max?>">
						<div class="help-block help-block-error "></div>
					</div>

				</div>
	
				<input type="text" hidden value="<?=$model->id_proceso?>" name="id_proceso">
				<div class="text-center">
					<?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
				</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>