<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Familiares */

$this->title = 'Actualizar Familiares: ' . ' ' . $familiar->nombres.' '.$familiar->apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Familiares', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="familiares-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formFamiliares', [
        'familiar' => $familiar,
    ]) ?>

</div>
