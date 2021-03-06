<script type="text/javascript">
	$(document).ready(function() {
		$('#doc').on('blur',  function(event) {
			event.preventDefault();
			famLista($('#doc').val(),'Seleccione un familiar');
		});	
	});
</script>
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Auxilios */

$this->title = 'Crear Auxilio';
if($tipo == '1'){
	$this->params['breadcrumbs'][] = ['label' => 'Auxilios', 'url' => ['indexdes']];
}else{
	$this->params['breadcrumbs'][] = ['label' => 'Auxilios', 'url' => ['indexexe']];
}
$this->params['breadcrumbs'][] = $this->title;
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
	<div class="auxilios-create col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'tipo' => $tipo,
	        'familiares' => $familiares,
	        'tipos'=> $tipos,
	    ]) ?>

	</div>
</div>
