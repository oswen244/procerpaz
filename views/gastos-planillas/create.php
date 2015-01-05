<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GastosPlanillas */

$this->title = 'Agregar gasto';
$this->params['breadcrumbs'][] = ['label' => 'Gastos Planillas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
	 <div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	       <li><?= Html::a('Listar gastos', ['index', 'id_planilla'=>$id_planilla], ['class' => '']) ?></li>
	       <li><?= Html::a('Volver a planilla', ['planillas/view', 'id'=>$id_planilla], ['class' => '']) ?></li>
	    </ul>
	</div>
	<div class="gastos-planillas-create col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'id_planilla'=>$id_planilla,
	    ]) ?>

	</div>
</div>


