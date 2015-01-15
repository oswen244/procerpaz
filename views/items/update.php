<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = 'Actualizar perfil: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Perfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
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
	<div class="items-update col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'accion'=>'actualizar',
	        'nodes'=>$nodes,
	    ]) ?>

	</div>
</div>
