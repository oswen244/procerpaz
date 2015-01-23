<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */

$this->title = $model->nombres." ".$model->apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="col-md-12">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked list-group">
            <li><?= Html::a('Actualizar información', ['update', 'id' => $model->id_cliente], ['class' => '']) ?></li>
            <li><a href="#" id="estado" class="">Cambiar estado del cliente</a></li>
            <li><?= Html::a('Familiares', ['familiares', 'id' => $model->id_cliente], ['class' => '']) ?></li>
            <li><?= Html::a('Mensualidad', ['mensualidades/index', 'id' => $model->id_cliente], ['class' => '']) ?></li>
            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Auxilios<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><?= Html::a('Auxilio de desempleo', ['auxilios/indexdescl', 'id' => $model->id_cliente], ['class' => '']) ?></li>
                    <li><?= Html::a('Auxilio exequial', ['auxilios/indexexecl', 'id' => $model->id_cliente], ['class' => '']) ?></li>
                </ul>
            </li>
            <li><?= Html::a('Prestamos', ['prestamos/indexcl', 'id' => $model->id_cliente], ['class' => '']) ?></li>
            <li><a href="index" class="">Listar clientes</a></li>
            <br>
            <li><?= Html::a('Eliminar cliente', ['delete', 'id' => $model->id_cliente], [
                'class' => '',
                'data' => [
                    'confirm' => '¿Está seguro que desea eliminar este cliente?',
                    'method' => 'post',
                ],
                ]) ?>
            </li>
        </ul>
    </div>
       
    <div class="clientes-view col-md-9">
        <!-- <p><img src="http://www.dolthink.com/wp-content/uploads/huellas1.png" data-toggle="modal" data-target="#logoModal" alt="logo" style="width:128px;height:128px"><p><br> -->
        <h1><?= Html::encode($this->title) ?></h1><br>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id_cliente',
                'num_afiliacion',
                'fecha_afiliacion',
                'nombres',
                'apellidos',
                'tipo_id',
                'num_id',
                'genero',
                'lugar_exp',
                'fecha_nacimiento',
                'grado',
                'pais',
                'ciudad',
                'email:email',
                'direccion',
                'telefono',
                // 'id_institucion',
                [
                    'attribute' => 'id_institucion',
                    'label'=>'Institución',
                    'value' => $model->idInstitucion->nombre,
                    
                ],
                'id_planilla',
                // 'id_estado',
                 [
                    'attribute' => 'id_estado',
                    'label'=>'Estado',
                    'value' => $model->idEstado->nombre,
                    
                ],
                // 'monto_paquete',
                 [
                    'attribute' => 'monto_paquete',
                    'value' => "$ ".number_format($model->monto_paquete,0)
                 ],
                 [
                    'label' => 'Fecha de vencimiento', 
                    'attribute' => 'fecha_ven',
                 ],
                'observaciones',
            ],
        ]) ?>

    </div>
</div>
<!-- Modal para modificar el estado del cliente -->
<div id="estadoModal" class="modal fade bs-example-modal-sm act" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Cambiar estado de <?=$model->nombres." ".$model->apellidos;?></h4>
            </div>
            <div class="modal-body">

                <?php $form = ActiveForm::begin(['action'=>'cambiar-estado', 'layout' => 'horizontal']) ?>
                    <div class="form-group field-clientes-id_estado required">
                        <label for="clientes-id_estado" class="control-label col-sm-4">Estado del cliente</label>
                        <div class="col-sm-7">
                            <select name="id_estado" required id="clientes-id_estado" class="form-control">
                                <option value=""></option>
                                <?php foreach($estados as $row){?>
                                    <option value="<?= $row['id_estado'];?>"><?= $row['nombre'];?></option>
                                <?php }?>
                            </select>
                            <div class="help-block help-block-error "></div>
                        </div>
                    </div>
                    <div class="form-group field-clientes-fecha_ven">
                        <div class="form-group field-clientes-fecha_ven">
                            <label for="clientes-fecha_ven" class="control-label col-sm-4">Fecha de vencimiento</label>
                            <div class="col-sm-7">
                                <?= yii\jui\DatePicker::widget(["id" => "clientes-fecha_ven", "name" => "fecha_ven", "dateFormat" => "yyyy-MM-dd", 'options' => ['disabled'=>'', 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
                            </div>            
                        </div>
                    </div>
                    <div class="form-group field-clientes-fecha_desafil">
                        <div class="form-group field-clientes-fecha_desafil">
                            <label for="clientes-fecha_desafil" class="control-label col-sm-4">Fecha de desafiliación</label>
                            <div class="col-sm-7">
                                <?= yii\jui\DatePicker::widget(["id" => "clientes-fecha_desafil", "name" => "fecha_desafil", "dateFormat" => "yyyy-MM-dd", 'options' => ['disabled'=>'', 'class' => 'fecha form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
                            </div>            
                        </div>
                    </div>
                    <input type="text" name="id_cliente" value="<?=$model->id_cliente;?>" hidden>
                    <div class="text-center">
                        <?= Html::submitButton('Guardar cambios', ['class' => 'btn btn-success']) ?>
                    </div>
                <?php ActiveForm::end(); ?>

            </div>
            <div class="modal-footer">
                <!-- <button id="gastoProm" type="button" class="btn btn-primary" data-dismiss="modal">Guardar cambios</button> -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
        $('#estado').on('click', function(event) {
            event.preventDefault();
            $('#estadoModal').modal({backdrop:'static'});
        });

        $('#clientes-id_estado').on('change', function(event) {
            event.preventDefault();
            if($(this).val() === '2' || $(this).val() === '9'){
                $('#clientes-fecha_ven').removeAttr('disabled');
            }else{
                $('#clientes-fecha_ven').attr('disabled','');
            }
        }); 

        $('#clientes-id_estado').on('change', function(event) {
            event.preventDefault();
            if($(this).val() === '3' || $(this).val() === '4' || $(this).val() === '6'){
                $('#clientes-fecha_desafil').removeAttr('disabled');
            }else{
                $('#clientes-fecha_desafil').attr('disabled','');
            }
        });    
   });
</script>
