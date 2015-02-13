<script type="text/javascript">
	$(document).ready(function() {
		$('#clienteName').html('<?=$model->idCliente->nombres." ".$model->idCliente->apellidos;?>');
		$('#doc').val('<?=$model->idCliente->num_id;?>');   
        $('#procesojuridico-id_abogado').val('<?=$model->id_abogado;?>');   
        $('#procesojuridico-id_estado').val('<?=$model->id_estado;?>'); 
        $('#procesojuridico-fecha').val('<?=$model->fecha;?>'); 
	});
</script>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProcesoJuridico */

$this->title = 'Actualizar Proceso jurídico: ' . ' ' . $model->id_proceso;
$this->params['breadcrumbs'][] = ['label' => 'Proceso Juridicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_proceso, 'url' => ['view', 'id' => $model->id_proceso]];
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
	<div class="proceso-juridico-update col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'abogados'=>$abogados,
		    'estados'=>$estados,
		    'id_usuario'=>$id_usuario,
	    ]) ?>

	</div>
</div>
