<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AvanceProceso */

$this->title = 'Actualizar Avance';
$this->params['breadcrumbs'][] = ['label' => 'Procesos juridicos', 'url' => ['proceso-juridico/index']];
$this->params['breadcrumbs'][] = ['label' => 'Avance Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="col-md-12">
     <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Regresar', ['index', 'id_p'=>$id_p], ['class' => '']) ?></li>
        </ul>
    </div>
	<div class="avance-proceso-update col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'id_p'=>$id_p,
	    ]) ?>

	</div>
</div>
