<script type="text/javascript">
	$(document).ready(function() {
		$('#procesojuridico-id_abogado').val('<?=$id_usuario;?>');  
	});
</script>
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProcesoJuridico */

$this->title = 'Crear Proceso Jurídico';
$this->params['breadcrumbs'][] = ['label' => 'Proceso Juridicos', 'url' => ['index']];
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
	<div class="proceso-juridico-create col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'abogados'=>$abogados,
	        'estados'=>$estados,
	        'id_usuario'=>$id_usuario,
	    ]) ?>

	</div>
</div>
