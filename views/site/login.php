<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Ingresar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <div class="col-md-12 text-center">
    <h1><?= Html::encode($this->title) ?></h1><br>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ?>
        
        <?= $form->field($model, 'username', ['template'=>"{label}\t<div class='col-md-4'>{input}</div>\n<div class=\"col-md-10\">{error}</div>", 'labelOptions'=>['class'=> 'col-md-4 control-label'],])->label('Usuario') ?>

        <?= $form->field($model, 'password', ['template'=>"{label}\t<div class='col-md-4'>{input}</div>\n<div class=\"col-md-10\">{error}</div>", 'labelOptions'=>['class'=> 'col-md-4 control-label']])->passwordInput()->label('Contraseña') ?>

        <?= $form->field($model, 'rememberMe', [
            'template' => "<div class=\"col-md-4\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])->checkbox()->label('Recuerdame') ?>

        <div class="form-group">
            <div class="text-center">
                <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    
</div>
