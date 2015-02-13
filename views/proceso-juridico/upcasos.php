<?php  
use yii\widgets\ActiveForm;
use yii\helpers\Html;

	$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data',  'name' => 'formulario1'], 'action' => 'upload']); ?>
			<div class="col-md-9">
				<input id="input-1" required name="UploadForm[file]" type="file" class="file filestyle" data-buttonName="btn-primary" data-buttonText="Examinar">
			</div>
			<input type="text" id="id_proceso" name="id_proceso" hidden>
			<input type="text" id="folder" name="folder" hidden>

			<div class="col-md-2">
				<button id="cargar" type="submit" class="btn btn-success" name="submit">Cargar archivo</button>
			</div>
	<?php ActiveForm::end(); ?>

