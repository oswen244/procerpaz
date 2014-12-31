<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Planillas */

$this->title = 'Planilla N° '.$model->id_planilla;
$this->params['breadcrumbs'][] = ['label' => 'Planillas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
     <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Listar planillas', ['index'], ['class' => '']) ?></li>
           <li><?= Html::a('Actualizar', ['update', 'id' => $model->id_planilla], ['class' => '']) ?></li>
           <li><?= Html::a('Asignar promotores', ['#', 'id' => $model->id_planilla], ['class' => '']) ?></li><br>
           <li>
               <?= Html::a('Eliminar', ['delete', 'id' => $model->id_planilla], [
                    'class' => '',
                    'data' => [
                        'confirm' => '¿Está seguro que desea eliminar esta planilla?',
                        'method' => 'post',
                    ],
                ]) ?>
            </li>
        </ul>
    </div>
    <div class="planillas-view col-md-9">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id_planilla',
                'fecha',
                'lugar',
                'unidad',
                // 'comision_afiliado',
                [
                    'attribute' => 'comision_afiliado',
                    'value' => "$ ".number_format($model->comision_afiliado,0)
                ],
                // 'por_ant_com',
                [
                    'attribute' => 'por_ant_com',
                    'value' => $model->por_ant_com."%",
                ],
               
            ],
        ]) ?>

    </div>
</div>
