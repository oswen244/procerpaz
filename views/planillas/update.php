<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Planillas */

$this->title = 'Update Planillas: ' . ' ' . $model->id_planilla;
$this->params['breadcrumbs'][] = ['label' => 'Planillas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_planilla, 'url' => ['view', 'id' => $model->id_planilla]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="planillas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
