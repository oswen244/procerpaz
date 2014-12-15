<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mensualidades */

$this->title = 'Update Mensualidades: ' . ' ' . $model->id_mensualidad;
$this->params['breadcrumbs'][] = ['label' => 'Mensualidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_mensualidad, 'url' => ['view', 'id' => $model->id_mensualidad]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mensualidades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
