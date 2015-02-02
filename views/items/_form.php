<script type="text/javascript">
    $(function () { $('#jstree_demo_div').jstree({
          "plugins" : [ "wholerow", "checkbox", "state"],
          "checkbox" : {
              "keep_selected_style" : false,
          },
        }); 
    });

    function updateArbol(selecc)
    {   
        var instancia = $('#jstree_demo_div').jstree();
        var x = instancia.get_state();
        var ids = [];
        $.each(selecc, function(index, val) {
            n = instancia.get_node('li[data-value="'+val+'"]');
            ids.push(n['id']);
        });
        x['core']['selected'] = ids;

        $('#jstree_demo_div').jstree().set_state(x);
        $('#jstree_demo_div').jstree().redraw(true);
    }

    function guardarArbol(accion)
    {
        $('#asignar').on('click', function(event) {
            event.preventDefault();
            
            var data = {};
            data[0] = instancia.get_top_selected(true);
            data[1] = $('#items-name').val();
            data[2] = $('#items-description').val();
             if(data[1] !== '' && data[2] !== ''){
                $.post(accion, {data: data}).done(function(data) {
                    console.log(data);
                });
            }else{alert('Debe llenar los campos de Nombre y Descripción')}

        });
        
    }

    function seleccionados(array)
    {
        var sel = [];
        $.each(array, function(index, val) {
            sel.push(val['child']);
        });
        return sel;
    }

    $(document).ready(function() {
            $('#jstree_demo_div').jstree().clear_state();

            if('<?=$accion;?>' == 'actualizar'){
                $('#jstree_demo_div').jstree().open_all();
                updateArbol(seleccionados($.parseJSON('<?=$nodes;?>')));
            }

            $('#permisos').on('click', function(event) {
                event.preventDefault();
                if('<?=$accion;?>' == 'actualizar'){
                $('#jstree_demo_div').jstree().open_all();
                    updateArbol(seleccionados($.parseJSON('<?=$nodes;?>')));
                }
                $('#PermisosModal').modal({backdrop:'static'});
             });

            $('#jstree_demo_div').on('changed.jstree', function (e, data) {
                instancia = data.instance;
                var i, j, r = [];
                for(i = 0, j = data.selected.length; i < j; i++) {
                    r.push(data.instance.get_node(data.selected[i]).text);
                }
                $('#event_result').html('Permisos: ' + r.join(', '));

            });
            guardarArbol('<?=$accion;?>');
    });
   
</script>
<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Items */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64])->label('Nombre') ?>

    <!-- <?= $form->field($model, 'type')->textInput() ?> -->

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Descripción') ?>

    <!-- <?= $form->field($model, 'rule_name')->textInput(['maxlength' => 64]) ?> -->

    <!-- <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'created_at')->textInput() ?> -->

    <!-- <?= $form->field($model, 'updated_at')->textInput() ?> -->


    <div class="text-center">
         <a id="permisos" class="text-center" href="">Asignar permisos</a><br><br>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div id="PermisosModal" class="modal fade bs-example-modal-sm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Asignar permisos</h4>
            </div>
            <div class="modal-body row">
                <div class="col-xs-12">
                    <div id="jstree_demo_div" class="col-xs-offset-2">
                        <ul>
                            <li data-value="admin">Administrador
                                <ul>
                                    <li data-value="clientes">Clientes
                                        <ul>
                                            <li data-value="leer_clientes">Ver clientes</li>
                                            <li data-value="editar_clientes">Editar clientes</li>
                                            <li data-value="crear_clientes">Crear clientes</li>
                                            <li data-value="borrar_clientes">Borrar clientes</li>
                                            <li data-value="planillas">Planillas
                                                <ul>
                                                    <li data-value="promotores">Promotores
                                                        <ul>
                                                            <li data-value="leer_promotores">Ver promotores</li>
                                                            <li data-value="editar_promotores">Editar promotores</li>
                                                            <li data-value="crear_promotores">Crear promotores</li>
                                                            <li data-value="borrar_promotores">Borrar promotores</li>
                                                        </ul>
                                                    </li>
                                                    <li data-value="leer_planillas">Ver planillas</li>
                                                    <li data-value="editar_planillas">Editar planillas</li>
                                                    <li data-value="crear_planillas">Crear planillas</li>
                                                    <li data-value="borrar_planillas">Borrar planillas</li>
                                                </ul>
                                            </li>
                                            <li data-value="instituciones">Instituciones
                                                <ul>
                                                    <li data-value="leer_instituciones">Ver Instituciones</li>
                                                    <li data-value="editar_instituciones">Editar Instituciones</li>
                                                    <li data-value="crear_instituciones">Crear Instituciones</li>
                                                    <li data-value="borrar_instituciones">Borrar Instituciones</li>
                                                </ul>                    
                                            </li>
                                            <li data-value="mensualidad">Mensualidades
                                                <ul>
                                                    <li data-value="leer_mensualidad">Ver mensualidades</li>
                                                    <li data-value="editar_mensualidad">Editar mensualidades</li>
                                                    <li data-value="crear_mensualidad">Crear mensualidades</li>
                                                    <li data-value="borrar_mensualidad">Borrar mensualidades</li>
                                                </ul>
                                            </li>
                                            <li data-value="familiares">Familiares
                                                <ul>
                                                    <li data-value="leer_familiares">Ver familiares</li>
                                                    <li data-value="editar_familiares">Editar familiares</li>
                                                    <li data-value="crear_familiares">Crear familiares</li>
                                                    <li data-value="borrar_familiares">Borrar familiares</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li data-value="auxilios">Auxilios
                                        <ul>                                
                                            <li data-value="auxilio_desempleo">Auxilios de desempleo
                                                <ul>
                                                    <li data-value="leer_auxilio_des">Ver auxilios de desempleo</li>
                                                    <li data-value="editar_auxilio_des">Editar auxilios de desempleo</li>
                                                    <li data-value="crear_auxilio_des">Crear auxilios de desempleo</li>
                                                    <li data-value="borrar_auxilio_des">Borrar auxilios de desempleo</li>
                                                </ul>
                                            </li>
                                            <li data-value="auxilio_exequial">Auxilios exequiales
                                                <ul>
                                                    <li data-value="leer_auxilio_exe">Ver auxlios exequiales</li>
                                                    <li data-value="editar_auxilio_exe">Editar auxlios exequiales</li>
                                                    <li data-value="crear_auxilio_exe">Crear auxlios exequiales</li>
                                                    <li data-value="borrar_auxilio_exe">Borrar auxlios exequiales</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li data-value="prestamos">Prestamos
                                        <ul>
                                            <li data-value="leer_prestamos">Ver prestamos</li>
                                            <li data-value="editar_prestamos">Editar prestamos</li>
                                            <li data-value="crear_prestamos">Crear prestamos</li>
                                            <li data-value="borrar_prestamos">Borrar prestamos</li>
                                        </ul>
                                    </li>
                                    <li data-value="proc_jur">Director Jurídico</li>
                                    <li data-value="abogado">Abogado</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div><br> <!-- Arbol -->
            </div>
            <div class="panel panel-default text-center"><div id="event_result" class="panel-body"></div></div>
            <div class="modal-footer">
                <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['id'=>'asignar', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <!-- <button id="asignar" type="button" class="btn btn-primary" data-dismiss="modal">Crear perfil</button> -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
