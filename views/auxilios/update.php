<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Auxilios */

$this->title = 'Update Auxilios: ' . ' ' . $model->id_auxilio;
$this->params['breadcrumbs'][] = ['label' => 'Auxilios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_auxilio, 'url' => ['view', 'id' => $model->id_auxilio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auxilios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
