<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mensualidades */

$this->title = 'Modificar Mensualidad: ' . ' ' . $model->id_mensualidad;
$this->params['breadcrumbs'][] = ['label' => 'Mensualidades', 'url' => ['index?id='.$id_cliente]];
$this->params['breadcrumbs'][] = ['label' => $model->id_mensualidad, 'url' => ['view', 'id' => $model->id_mensualidad]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="col-md-12">
	<div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	        <li><?= Html::a('Regresar a mensualidades', ['index', 'id' => $id_cliente], ['class' => '']) ?></li><br>
	        <li><a href="clientes/index">Listar clientes</a></li>
	    </ul>
	</div>
	<div class="mensualidades-update col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

	</div>
</div>
