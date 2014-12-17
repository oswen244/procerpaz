<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Auxilios */

$this->title = $model->id_auxilio;
if($model->tipo == '1'){
    $this->params['breadcrumbs'][] = ['label' => 'Auxilios', 'url' => ['indexdes']];
}else{
    $this->params['breadcrumbs'][] = ['label' => 'Auxilios', 'url' => ['indexexe']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auxilios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_auxilio], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_auxilio], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_auxilio',
            'tipo',
            'porcentaje_aux',
            'monto',
            'num_meses',
            'fecha_auxilio',
            'proveedor',
            'estado',
            'id_cliente',
            'tipo_auxilio',
        ],
    ]) ?>

</div>
