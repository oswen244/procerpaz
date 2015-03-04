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
                <div class="text-center"><?= Html::tag('h5', (isset($m)) ? '*El archivo debe tener la extensión .csv' : '' ,['class'=> 'help-block']);?></div>
            </div>
        </div>
<div class="text-center"><?= Html::tag('h3', (isset($m)) ? $m : '' ,['class'=> 'help-block']);?></div>
        <?php $form = ActiveForm::begin(['action'=>'cargar', 'layout' => 'horizontal']) ?>
            
            <?php if(isset($filename)){ ?>
                <input type="text" name="archivo_nom" value="<?=$filename?>" hidden>
            <?php } ?>
            <!-- Institución -->
            <div class="selcol">
            <label for="" class="control-label col-sm-4">Institución</label>
            <div class="form-group col-sm-5">
                <select name="institucion" type="date" id="instituciones" required class="form-control">
                    <option value=""></option>
                     <?php foreach($instituciones as $row){?>
                        <option value="<?= $row['id_institucion'];?>"><?= $row['nombre'];?></option>
                    <?php }?>
                </select>
            </div>
            </div>

            <!-- # de documento -->
            <div class="selcol">
            <label for="" class="control-label col-sm-4">N° de documento</label>
            <div class="form-group col-sm-5">
                <select name="doc" id="documento" required class="form-control">
                    <option value=""></option>
                    <?php if(isset($totalCol)){ ?>
                        <?php for ($i=1; $i <= $totalCol; $i++) { ?>
                            <option value="<?=$i;?>">Columna <?=$i;?></option>
                       <?php } ?>
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
                    <?php if(isset($totalCol)){ ?>
                        <?php for ($i=1; $i <= $totalCol; $i++) { ?>
                            <option value="<?=$i;?>">Columna <?=$i;?></option>
                       <?php } ?>
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
                    <?php if(isset($totalCol)){ ?>
                        <?php for ($i=1; $i <= $totalCol; $i++) { ?>
                            <option value="<?=$i;?>">Columna <?=$i;?></option>
                       <?php } ?>
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
        if('<?= isset($cadena) ? true : false ?>' === '1'){
            $('.selcol').show();
            $('#table').html("<?= isset($cadena) ? $cadena : '' ?>");
        }else{
            $('.selcol').hide();
        }
    });
</script>