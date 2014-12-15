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
                <li><?= Html::a('Regresar a información de cliente', ['view', 'id' => $id_cliente], ['class' => '']) ?></li><br>
                <li><a href="index">Listar clientes</a></li>
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
                'id_cliente',
                'id_parentezco',
            ],
        ]) ?>

    </div>
</div>
