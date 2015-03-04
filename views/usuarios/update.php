<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Actualizar usuario: ' . ' ' . $model->usuario;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->usuario, 'url' => ['view', 'id' => $model->id_usuario]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="col-md-12">
	 <div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	       <li><?= Html::a('Listar usuarios', ['index'], ['class' => '']) ?></li>
	       <li><?= Html::a('Información del usuario', ['view', 'id'=>$model->id_usuario], ['class' => '']) ?></li>
	    </ul>
	</div>
	<div class="usuarios-update col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'perfiles'=>$perfiles,
	    ]) ?>

	</div>
</div>
