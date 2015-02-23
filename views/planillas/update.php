<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Planillas */

$this->title = 'Actualizar Planilla N° ' . ' ' . $model->numero;
$this->params['breadcrumbs'][] = ['label' => 'Planillas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->numero, 'url' => ['view', 'id' => $model->id_planilla]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>

<div class="col-md-12">
	 <div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	       <li>
	       		<?= Html::a('Listar planillas', ['index'], ['class' => '']) ?>
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
