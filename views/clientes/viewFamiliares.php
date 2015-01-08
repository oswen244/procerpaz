<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $familiar app\familiars\Familiares */

$this->title = $familiar->nombres." ".$familiar->apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Familiares', 'url' => ['familiares?id='.$id_cliente]];
$this->params['breadcrumbs'][] = $this->title;
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
    <div class="familiares-view col-md-9">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $familiar,
            'attributes' => [
                // 'id_familiar',
                'nombres',
                'apellidos',
                'tipo_id',
                'num_id',
                'genero',
                'fecha_nacimiento',
                'pais',
                'ciudad',
                'email:email',
                'direccion',
                'telefono',
                // 'parentezco',
                [
                    'attribute'=>'id_cliente',
                    'value'=>$familiar->idCliente->nombres.' '.$familiar->idCliente->apellidos,
                ],
                // 'id_parentezco',
                [
                    'attribute'=>'id_parentezco',
                    'value'=>$familiar->idParentezco->parentezco,
                ],
            ],
        ]) ?>

    </div>
</div>
