<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AvanceProceso */

$this->title = 'Update Avance Proceso: ' . ' ' . $model->id_avance;
$this->params['breadcrumbs'][] = ['label' => 'Avance Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_avance, 'url' => ['view', 'id' => $model->id_avance]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="avance-proceso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
