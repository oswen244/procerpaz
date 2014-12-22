<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Planillas */

$this->title = 'Actualizar Planilla N° ' . ' ' . $model->id_planilla;
$this->params['breadcrumbs'][] = ['label' => 'Planillas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_planilla, 'url' => ['view', 'id' => $model->id_planilla]];
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
	<div class="planillas-update col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

	</div>
</div>
