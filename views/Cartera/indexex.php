<script type="text/javascript">
    $(document).ready(function() {
    });
</script>

<?php 
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
 ?>
<div class="panel panel-default">
    <div class="panel-body">        
        <?php $form = ActiveForm::begin(['action'=>'generar', 'layout' => 'horizontal']) ?>
            <!-- Tipo de archivo -->
            <label for="" class="control-label col-sm-4">Tipo de archivo</label>
            <div class="form-group col-sm-5">
                <select name="t_archivo" id="instituciones" required class="form-control">
                    <option value=""></option>
                    <option value="1">Nuevos descuentos</option>
                    <option value="2">Descuentos a cancelar</option>
                </select>
                <!-- <div class="help-block help-block-error "></div> -->
            </div>

            <!-- Institución -->
            <label for="" class="control-label col-sm-4">Institución</label>
            <div class="form-group col-sm-5">
                <select name="institucion" type="date" id="instituciones" required class="form-control">
                    <option value=""></option>
                     <?php foreach($instituciones as $row){?>
                        <option value="<?= $row['id_institucion'];?>"><?= $row['nombre'];?></option>
                    <?php }?>
                </select>
                <!-- <div class="help-block help-block-error "></div> -->
            </div>

            <!-- Fecha de reporte -->
            <label for="" class="control-label col-sm-4">Fecha</label>
            <div class="form-group col-sm-5">
                <?= yii\jui\DatePicker::widget(["id" => "fecha_reporte",  'name'=>'cartera_fecha', "dateFormat" => "yyyy-MM-dd", 'options' => ['required'=>'true', 'class' => 'form-control', "placeholder" => "año-mes-dia"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
            </div>

            <div class="text-center col-sm-12">
                <?= Html::submitButton('Generar', ['class' => 'btn btn-success']) ?>
            </div>            
        <?php ActiveForm::end(); ?>
    </div>
</div>
