<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\Clientes;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProcesoJuridicoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Procesos Juridicos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-center"><?= Html::tag('h3', (isset($_GET['m']) && $_GET['m']==='1') ? 'No se puede eliminar el proceso. Borre primero todos los avances relacionados' : (isset($_GET['m']) ? 'El proceso ha sido borrado' : ''),['class'=> 'help-block']);?></div>
<div class="proceso-juridico-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => ['class' => 'proc text-center'],
        'id'=>'tablaProc',
        'filterModel' => $searchModel,
        'beforeHeader'=>[
            [
                'columns'=>[
                    ['content'=>'Cliente', 'options'=>['colspan'=>2, 'class'=>'text-center']],
                    ['content'=>'Abogado', 'options'=>['colspan'=>2, 'class'=>'text-center']],
                    ['content'=>'Proceso', 'options'=>['colspan'=>2, 'class'=>'text-center']],
                ],
                'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],
        'columns' => [

            // 'id_proceso',
            [
                'attribute'=>'nombre_cliente',
                'label'=>'Nombres',
                'value'=> 'idCliente.nombres',
            ],
             [
                'attribute'=>'apellido_cliente',
                'label'=>'Apellidos',
                'value'=> 'idCliente.apellidos',
            ],
            // 'id_abogado',
            [
                'attribute'=>'nombre_abogado',
                'label'=>'Nombres',
                'value'=> 'idAbogado.nombres',
            ],
            [
                'attribute'=>'apellido_abogado',
                'label'=>'Apellidos',
                'value'=> 'idAbogado.apellidos',
            ],
            // 'tiempo_max',
            // 'id_estado',
            [
                'attribute'=>'estado',
                'value'=> 'idEstado.nombre',
                'options'=>['width'=>'10%'],
            ],
            // 'peso_max',
            // 'fecha',
            [
                'attribute' => 'fecha',
                'options'=>['width'=>'10%'],
            ],
            // 'hora',

            [
                'label' => 'Acciones', 
                'vAlign' => 'middle',
                'value' =>  function($model){
                    return  Html::a('', ['avance-proceso/index', 'id_p'=>$model->id_proceso], ['class' => 'glyphicon glyphicon-forward', 'title'=>'Avances']).'&nbsp'.
                            Html::a('', ['clientes/view', 'id'=>$model->id_cliente], ['class' => 'glyphicon glyphicon-info-sign', 'title'=>'Ver info de cliente']).'&nbsp'.
                            Html::a('', ['update', 'id'=>$model->id_proceso], ['class' => Yii::$app->user->can('dir_juridico') ? 'glyphicon glyphicon-pencil' : '', 'title'=>'Actualizar']).'&nbsp'.
                            Html::a('', ['configuracion', 'id'=>$model->id_proceso], ['class' => Yii::$app->user->can('dir_juridico') ? 'glyphicon glyphicon-cog' : '', 'title'=>'Configuración']).'&nbsp'.
                            Html::a('', ['delete', 'id' => $model->id_proceso], ['class' => Yii::$app->user->can('dir_juridico') ? 'glyphicon glyphicon-trash' : '',
                            'data' => [
                                'confirm' => '¿Está seguro que desea borrar este proceso?',
                                'method' => 'post',
                            ],
                            'title'=>'Eliminar',

                        ]);
                },
                'format' => 'raw',
                'options'=>['width'=>'10%'],
            ],

        ],
        'toolbar' => [
            ['content'=> Yii::$app->user->can('dir_juridico') ?
                Html::a('Crear proceso', ['create', 'id'=>0], ['class' => 'btn btn-success']) : '',
            ],
            '{export}',
        ],
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-folder-open"></i>  Procesos Jurídicos',
        ],
    ]); ?>

</div>

<div id="archivoModal" class="modal fade bs-example-modal-sm act" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Subir archivo al caso</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                   <?=$this->render('upcasos',[
                   ]);  ?>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.arch_cas').on('click', function(event) {
            event.preventDefault();
            $('#archivoModal').modal({backdrop:'static'});
            $(document).on('click', '#tablaProc tr.proc',function(event) {
                $('#id_proceso').attr('value', $(this).attr('data-key'));
                $('#folder').attr('value', 'avances');
            });

        });    
    });
</script>