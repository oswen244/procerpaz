<script type="text/javascript">
	$(document).ready(function() {
		$('#prestamos-num_cuotas').on('blur', function(event) {
			var cuota = valorCuota($('#prestamos-monto').val(),$('#prestamos-interes_mensual').val(),$('#prestamos-num_cuotas').val());
			$('#prestamos-valor_cuota').val(cuota);		
		});
	});
</script>
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prestamos */

$this->title = 'Crear Prestamo';
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
	 <div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	       <li>
       		<?= Html::a('Regresar', ['index'], ['class' => '']) ?>
	       </li>
	    </ul>
	</div>
	<div class="prestamos-create col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'estados'=>$estados,
	    ]) ?>

	</div>
</div>
