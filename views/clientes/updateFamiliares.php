<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Familiares */

$this->title = 'Actualizar Familiares: ' . ' ' . $familiar->nombres.' '.$familiar->apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Familiares', 'url' => ['familiares?id='.$id_cliente]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>

<div class="col-md-12">
	<div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
            <li><?= Html::a('Listar familiares', ['familiares', 'id' => $id_cliente], ['class' => '']) ?></li>
            <li><?= Html::a('Regresar a información de cliente', ['view', 'id' => $id_cliente], ['class' => '']) ?></li>
            <li><a href="index">Listar clientes</a></li>
            <br>
            <li><?= Html::a('Eliminar familiar', ['delete-familiar', 'id' => $familiar->id_familiar], [
                'class' => '',
                'data' => [
                    'confirm' => 'Está seguro que desea eliminar este familiar?',
                    'method' => 'post',
                ],
                ]) ?>
            </li>
        </ul>
    </div>
	<div class="familiares-update col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_formFamiliares', [
	        'familiar' => $familiar,
            'id_cliente' => $id_cliente,
            'parentezcos' => $parentezcos,
            'rango_fecha'=>$rango_fecha,
	    ]) ?>

	</div>
</div>
