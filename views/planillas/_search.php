<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PlanillasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planillas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_planilla') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'lugar') ?>

    <?= $form->field($model, 'unidad') ?>

    <?= $form->field($model, 'comision_afiliado') ?>

    <?php // echo $form->field($model, 'por_ant_com') ?>

    <?php // echo $form->field($model, 'id_usuario') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
