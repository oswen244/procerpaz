<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Instituciones */

$this->title = 'Actualizar Institución: ' . ' ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Instituciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_institucion, 'url' => ['view', 'id' => $model->id_institucion]];
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
	<div class="instituciones-update col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

	</div>
</div>
