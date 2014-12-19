<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PagosAuxilios */

$this->title = 'Agregar Pago de Auxilio';
$this->params['breadcrumbs'][] = ['label' => 'Pagos Auxilios', 'url' => ['index?id_auxilio='.$id_auxilio.'&monto='.$cuota]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
	<div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	       <li><?= Html::a('Regresar', ['index', 'monto' => $_GET['cuota'], 'id_auxilio'=>$_GET['id_auxilio']], ['class' => '']) ?></li>
	    </ul>
	</div>
	<div class="pagos-auxilios-create col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'cuota'=>$cuota,
	        'id_auxilio'=>$id_auxilio,
	    ]) ?>

	</div>
</div>
