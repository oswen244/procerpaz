<?php 
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
 ?>
<div class="panel panel-default">
    <div class="panel-body"> 

        <div class="panel panel-default">
            <div class="panel-body"> 
                <div class="col-sm-6 col-sm-offset-3">
                    <?= $this->render('upload', [
                    ]) ?>
                </div>
            </div>
        </div>

        <?php $form = ActiveForm::begin(['action'=>'#', 'layout' => 'horizontal', 'options' => ['enctype' => 'multipart/form-data',  'name' => 'formulario1']]) ?>
            

            <!-- # de documento -->
            <div class="selcol">
            <label for="" class="control-label col-sm-4">N° de documento</label>
            <div class="form-group col-sm-5">
                <select name="doc" id="documento" required class="form-control">
                    <option value=""></option>
                    <?php for ($i=1; $i <= 20; $i++) { ?>
                        <option value="<?=$i;?>">Columna <?=$i;?></option>
                   <?php } ?>
                </select>
            </div>
            </div>

            <!-- Nombre -->
            <div class="selcol">
            <label for="" class="control-label col-sm-4">Nombre</label>
            <div class="form-group col-sm-5">
                <select name="nom" id="nombre" required class="form-control">
                    <option value=""></option>
                    <?php for ($i=1; $i <= 20; $i++) { ?>
                        <option value="<?=$i;?>">Columna <?=$i;?></option>
                   <?php } ?>
                </select>
            </div>
            </div>

            <!-- Monto -->
            <div class="selcol">
            <label for="" class="control-label col-sm-4">Monto</label>
            <div class="form-group col-sm-5">
                <select name="mon" id="monto" required class="form-control">
                    <option value=""></option>
                    <?php for ($i=1; $i <= 20; $i++) { ?>
                        <option value="<?=$i;?>">Columna <?=$i;?></option>
                   <?php } ?>
                </select>
            </div>
           </div>
        
            <div class="text-center col-sm-12">
                <?= Html::submitButton('Guardar', ['class' => 'selcol btn btn-primary']) ?>
            </div>            
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div id="table"></div>


<script type="text/javascript">
    $(document).ready(function() {
        if('<?= isset($foo) ? true : false ?>' === '1'){
            $('.selcol').show();
            console.log('<?= isset($foo) ? print_r($foo) : '' ?>');
            $('#table').html(importTable('<?= isset($foo) ? print_r($foo) : '' ?>'));
        }else{
            $('.selcol').hide();
        }
    });
</script>