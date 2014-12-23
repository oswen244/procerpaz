<script type="text/javascript">
	$(document).ready(function() {
		$('#familiares-num_id').attr('disabled', 'true');
		$('#familiares-tipo_id').on('change', function() {
			if($('#familiares-tipo_id').val() != '')
				$('#familiares-num_id').removeAttr('disabled');
			else
				$('#familiares-num_id').attr('disabled', 'true');
		});	
	});
</script>
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Familiares */

$this->title = 'Agregar Familiares';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Familiares', 'url' => ['familiares?id='.$id_cliente]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
	<div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	       <li><?= Html::a('Regresar a familiares', ['familiares', 'id' => $id_cliente], ['class' => '']) ?></li>
	       <li><?= Html::a('Regresar a información de cliente', ['view', 'id' => $id_cliente], ['class' => '']) ?></li>
	        <li><?= Html::a('Listar clientes', ['index'], ['class' => '']) ?></li>
	    </ul>
	</div>
	<div class="familiares-create col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_formFamiliares', [
	        'familiar' => $familiar, //este es el modelo
	        'id_cliente' => $id_cliente,
	        'parentezcos' => $parentezcos,
	    ]) ?>

	</div>
</div>
