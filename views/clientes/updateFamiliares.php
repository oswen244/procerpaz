<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Familiares */

$this->title = 'Actualizar Familiares: ' . ' ' . $familiar->nombres.' '.$familiar->apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Familiares', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="col-md-12">
	<div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	        <li><?= Html::a('Regresar a información de familiar', ['view-familiar', 'id' => $familiar->id_familiar, 'idc' => $id_cliente], ['class' => '']) ?></li><br>
	        <li><a href="index">Listar clientes</a></li>
	    </ul>
	</div>
	<div class="familiares-update col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1>

	    <?= $this->render('_formFamiliares', [
	        'familiar' => $familiar,
	    ]) ?>

	</div>
</div>
