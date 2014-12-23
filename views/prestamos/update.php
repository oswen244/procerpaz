<script type="text/javascript">
	$(document).ready(function() {
		$('#doc').val('<?=$num_id;?>');
	});
</script>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prestamos */

$this->title = 'Actualizar prestamo: ' . ' ' . $model->id_prestamo;
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prestamo, 'url' => ['view', 'id' => $model->id_prestamo]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="col-md-12">
	 <div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	       <li>
			<?= Html::a('Regresar', ['index'], ['class' => '']) ?>
	       </li>
	    </ul>
	</div>
	<div class="prestamos-update col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'estados'=>$estados,
	    ]) ?>

	</div>
</div>
