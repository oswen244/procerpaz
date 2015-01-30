<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Ingresar';
$this->params['breadcrumbs'][] = $this->title;
?>

<div style="padding:7% 10%">
    <div class="panel panel-default panel-login">
        <div class="site-login panel-body">
            <p class="text-center"><img src="<?= Yii::$app->request->baseUrl; ?>/images/logo.png" alt="Proserpaz"></p>
            <div class="col-md-12 text-center">
            <h3><?= Html::encode($this->title) ?></h3><br>

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
                        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            
        </div>
    </div>
</div>