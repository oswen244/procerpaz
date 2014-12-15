<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prestamos */

$this->title = 'Update Prestamos: ' . ' ' . $model->id_prestamo;
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prestamo, 'url' => ['view', 'id' => $model->id_prestamo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prestamos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
