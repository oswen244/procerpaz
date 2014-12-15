<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Instituciones */

$this->title = 'Update Instituciones: ' . ' ' . $model->id_institucion;
$this->params['breadcrumbs'][] = ['label' => 'Instituciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_institucion, 'url' => ['view', 'id' => $model->id_institucion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="instituciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
