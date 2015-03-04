<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use app\models\Usuarios;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="text-center">(*) campos requeridos.</div><br>
<div class="usuarios-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => 45])->label('Nombres *') ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => 45])->label('Apellidos *') ?>

    <?= $form->field($model, 'cargo')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'pais')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => 45]) ?>

    <div class="form-group field-usuarios-genero required">
        <label for="usuarios-genero" class="control-label col-sm-3">Sexo</label>
        <div class="col-sm-6">
            <select name="Usuarios[genero]" id="usuarios-genero" class="form-control">
                <option value=""></option>
                <option value="<?=Usuarios::MASCULINO?>"><?=Usuarios::MASCULINO?></option>
                <option value="<?=Usuarios::FEMENINO?>"><?=Usuarios::FEMENINO?></option>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

    <!-- <?= $form->field($model, 'genero')->textInput(['maxlength' => 1]) ?> -->

    <?= $form->field($model, 'celular')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'usuario')->textInput(['maxlength' => 45])->label('Usuario *') ?>
    
    <?= $form->field($model, 'contrasena')->passwordInput(['maxlength' => 45])->label('Contraseña *') ?>

    <div class="form-group field-usuarios-perfil required">
        <label for="usuarios-perfil" class="control-label col-sm-3">Perfil *</label>
        <div class="col-sm-6">
            <select name="Usuarios[perfil]" id="usuarios-perfil" class="form-control">
                 <?php foreach($perfiles as $row){?>
                    <option value="<?= $row['name'];?>"><?= $row['description'];?></option>
                <?php }?>
            </select>
            <div class="help-block help-block-error "></div>
        </div>
    </div>

    <!-- <?= $form->field($model, 'perfil')->textInput(['maxlength' => 45])->label('') ?> -->

    <?= $form->field($model, 'estado')->hiddenInput()->label('') ?>

    <div class="text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
   $(document).ready(function() {
        $('#usuarios-perfil').val('<?=$model->perfil;?>');
    });
</script>