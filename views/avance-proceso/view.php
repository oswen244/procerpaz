<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AvanceProceso */

$this->title = 'Avance N° '.$model->id_avance;
$this->params['breadcrumbs'][] = ['label' => 'Avance Procesos', 'url' => ['index?id_p='.$id_p]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
     <div class="col-md-2">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Regresar', ['index', 'id_p'=>$id_p], ['class' => '']) ?></li>
           <li><?= Html::a('Actualizar', ['update', 'id' => $model->id_avance, 'id_p'=>$model->id_proceso], ['class' => '']) ?></li><br>
           <li><?= Html::a('Eliminar', ['delete', 'id' => $model->id_avance, 'id_p'=>$model->id_proceso], [
                'class' => '',
                'data' => [
                    'confirm' => '¿Está seguro que desea borrar este avance?',
                    'method' => 'post',
                ],
            ]) ?></li>
        </ul>
    </div>
    <div class="text-center"><?= Html::tag('h3', isset($m) ? $m : '' ,['class'=> 'help-block']);?></div>
    <div class="avance-proceso-view col-md-10">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id_avance',
                // 'id_proceso',
                'fecha',
                'hora',
                'avance',
            ],
        ]) ?>

    </div>
</div>
