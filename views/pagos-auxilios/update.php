<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagosAuxilios */

$this->title = 'Update Pagos Auxilios: ' . ' ' . $model->id_pago;
$this->params['breadcrumbs'][] = ['label' => 'Pagos Auxilios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pago, 'url' => ['view', 'id' => $model->id_pago]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pagos-auxilios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
