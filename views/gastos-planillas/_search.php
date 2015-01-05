<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GastosPlanillasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-planillas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_gastos_planillas') ?>

    <?= $form->field($model, 'valor') ?>

    <?= $form->field($model, 'fuente') ?>

    <?= $form->field($model, 'asumido_por') ?>

    <?= $form->field($model, 'Detalle') ?>

    <?php // echo $form->field($model, 'id_planilla') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
