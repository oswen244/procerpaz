<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Instituciones */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Instituciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
     <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Listar instituciones', ['index'], ['class' => '']) ?></li>
           <li><?= Html::a('Actualizar', ['update', 'id' => $model->id_institucion], ['class' => '']) ?></li><br>
           <li>
               <?= Html::a('Eliminar', ['delete', 'id' => $model->id_institucion], [
                    'class' => '',
                    'data' => [
                        'confirm' => '¿Está seguro que desea eliminar esta planilla?',
                        'method' => 'post',
                    ],
                ]) ?>
            </li>
        </ul>
    </div>
    <div class="instituciones-view col-md-9">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id_institucion',
                'nombre',
                'descripcion',
            ],
        ]) ?>

    </div>
</div>
