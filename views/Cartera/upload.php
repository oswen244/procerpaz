<?php  
use yii\widgets\ActiveForm;
use yii\helpers\Html;

	$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data',  'name' => 'formulario1'], 'action' => 'upload']); ?>
			<div class="col-md-9">
				<input id="input-1" required name="UploadForm[file]" type="file" class="file filestyle" data-buttonName="btn-primary" data-buttonText="Examinar">
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-success" name="submit">Ver archivo</button>
			</div>
	<?php ActiveForm::end(); ?>