<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Promotores */

$this->title = $model->nombres.' '.$model->apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Promotores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Listar promotores', ['index'], ['class' => '']) ?></li>
           <li><?= Html::a('Actualizar', ['update', 'id' => $model->id_promotor], ['class' => '']) ?></li><br>
           <li>
               <?= Html::a('Eliminar', ['delete', 'id' => $model->id_promotor], [
                    'class' => '',
                    'data' => [
                        'confirm' => '¿Está seguro que desea eliminar este promotor?',
                        'method' => 'post',
                    ],
                ]) ?>
            </li>
        </ul>
    </div>
    <div class="promotores-view col-md-9">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id_promotor',
                'nombres',
                'apellidos',
            ],
        ]) ?>

    </div>
</div>
