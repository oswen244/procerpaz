<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mensualidades */

$this->title = 'Agregar Mensualidad';
$this->params['breadcrumbs'][] = ['label' => 'Mensualidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
	<div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	       <li><?= Html::a('Regresar a mensualidades', ['index', 'id' => $id_cliente], ['class' => '']) ?></li>
	       <li><?= Html::a('Regresar a información de cliente', ['clientes/view', 'id' => $id_cliente], ['class' => '']) ?></li>
	        <li><?= Html::a('Listar clientes', ['clientes/index'], ['class' => '']) ?></li>
	    </ul>
	</div>
	<div class="mensualidades-create col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

	</div>
</div>
