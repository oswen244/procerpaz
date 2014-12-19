<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */

$this->title = $model->nombres." ".$model->apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="col-md-12">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
            <li><?= Html::a('Actualizar información', ['update', 'id' => $model->id_cliente], ['class' => '']) ?></li>
            <li><?= Html::a('Familiares', ['familiares', 'id' => $model->id_cliente], ['class' => '']) ?></li>
            <li><?= Html::a('Mensualidad', ['mensualidades/index', 'id' => $model->id_cliente], ['class' => '']) ?></li>
            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Auxilios<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><?= Html::a('Auxilio de desempleo', ['auxilios/indexdescl', 'id' => $model->id_cliente], ['class' => '']) ?></li>
                    <li><?= Html::a('Auxilio exequial', ['auxilios/indexexecl', 'id' => $model->id_cliente], ['class' => '']) ?></li>
                </ul>
            </li>
            <li><?= Html::a('Prestamos', ['prestamos/indexcl', 'id' => $model->id_cliente], ['class' => '']) ?></li>
            <li><a href="index">Listar clientes</a></li>
            <br>
            <li><?= Html::a('Eliminar cliente', ['delete', 'id' => $model->id_cliente], [
                'class' => '',
                'data' => [
                    'confirm' => '¿Está seguro que desea eliminar este cliente?',
                    'method' => 'post',
                ],
                ]) ?>
            </li>
        </ul>
    </div>
       
    <div class="clientes-view col-md-9">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id_cliente',
                'num_afiliacion',
                'fecha_afiliacion',
                'nombres',
                'apellidos',
                'tipo_id',
                'num_id',
                'genero',
                'lugar_exp',
                'fecha_nacimiento',
                'grado',
                'pais',
                'ciudad',
                'email:email',
                'direccion',
                'telefono',
                // 'id_institucion',
                [
                    'attribute' => 'id_institucion',
                    'label'=>'Institución',
                    'value' => $model->idInstitucion->nombre,
                    
                ],
                'id_planilla',
                // 'id_estado',
                 [
                    'attribute' => 'id_estado',
                    'label'=>'Estado',
                    'value' => $model->idEstado->nombre,
                    
                ],
                // 'monto_paquete',
                 [
                    'attribute' => 'monto_paquete',
                    'value' => "$ ".number_format($model->monto_paquete,0)
                 ],
                'observaciones',
            ],
        ]) ?>

    </div>
</div>
