<?php

use yii\helpers\Html;
use app\models\Auxilios;

/* @var $this yii\web\View */
/* @var $model app\models\Auxilios */

$this->title = 'Actualizar Auxilio: ' . ' ' . $model->id_auxilio;
if($tipo == '1'){
	$this->params['breadcrumbs'][] = ['label' => 'Auxilios', 'url' => ['indexdes']];
}else{
	$this->params['breadcrumbs'][] = ['label' => 'Auxilios', 'url' => ['indexexe']];
}
$this->params['breadcrumbs'][] = ['label' => $model->id_auxilio, 'url' => ['view', 'id' => $model->id_auxilio]]; 
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="col-md-12">
	 <div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	       <li>
			<?php if($tipo == '1'){ ?>
	       		<?= Html::a('Regresar', ['indexdes'], ['class' => '']) ?>
			<?php }else{ ?>
				<?= Html::a('Regresar', ['indexexe'], ['class' => '']) ?>
			<?php } ?>
	       </li>
	    </ul>
	</div>
	<div class="auxilios-update col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'tipo' => $tipo,
	        'familiares' => $familiares,
	        'tipos'=>$tipos,
	    ]) ?>

	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#doc').val('<?=$num_id;?>');
		
	});
</script>
