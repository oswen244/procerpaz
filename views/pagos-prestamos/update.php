<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagosPrestamos */

$this->title = 'Actualizar Pago: ' . ' ' . $model->id_pagos;
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['prestamos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Pagos Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pagos, 'url' => ['view', 'id' => $model->id_pagos]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pagos-prestamos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
