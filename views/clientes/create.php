<script type="text/javascript">
	$(document).ready(function() {
		$('#clientes-num_id').attr('disabled', 'true');
		$('#clientes-tipo_id').on('change', function() {
			if($('#clientes-tipo_id').val() != '')
				$('#clientes-num_id').removeAttr('disabled');
			else
				$('#clientes-num_id').attr('disabled', 'true');
		});	
	});
</script>
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Clientes */

$this->title = 'Crear Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
	 <div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	       <li>
	       		<?= Html::a('Listar clientes', ['index'], ['class' => '']) ?>
	       </li>
	    </ul>
	</div>
	<div class="clientes-create col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'instituciones' => $instituciones,
	        'planillas' => $planillas,
	        'estados' => $estados,
	        'rango_fecha'=>$rango_fecha,
	    ]) ?>

	</div>
</div>