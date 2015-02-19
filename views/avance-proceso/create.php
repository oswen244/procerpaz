<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AvanceProceso */

$this->title = 'Crear avance de proceso';
$this->params['breadcrumbs'][] = ['label' => 'Avance Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-center"><?= Html::tag('h3', (isset($_GET['m']) && $_GET['m']==='1') ? 'Archivo cargado!' : (isset($_GET['m']) ? 'Error al subir el archivo' : ''),['class'=> 'help-block']);?></div>
<div class="col-md-12">
     <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Regresar', ['index', 'id_p'=>$id_p], ['class' => '']) ?></li>
        </ul>
    </div>
	<div class="avance-proceso-create col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'id_p'=>$id_p,
	    ]) ?>

	</div>
</div>
