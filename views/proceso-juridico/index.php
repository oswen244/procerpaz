<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProcesoJuridicoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Procesos Juridicos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-center"><?= Html::tag('h3', (isset($_GET['m']) && $_GET['m']==='1') ? 'Archivo cargado!' : (isset($_GET['m']) ? 'Error al subir el archivo' : ''),['class'=> 'help-block']);?></div>
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
                'attribute'=>'id_cliente',
                'label'=>'Nombres',
                'value'=> function($model){
                    return $model->idCliente->nombres;
                }
            ],
             [
                'attribute'=>'id_cliente',
                'label'=>'Apellidos',
                'value'=> function($model){
                    return $model->idCliente->apellidos;
                }
            ],
            // 'id_abogado',
            [
                'attribute'=>'id_abogado',
                'label'=>'Nombres',
                'value'=> function ($model){
                    return $model->idAbogado->nombres;
                }
            ],
            [
                'attribute'=>'id_abogado',
                'label'=>'Apellidos',
                'value'=> function ($model){
                    return $model->idAbogado->apellidos;
                }
            ],
            // 'tiempo_max',
            // 'id_estado',
            [
                'attribute'=>'id_estado',
                'label'=>'Estado',
                'value'=> function($model){
                    return $model->idEstado->nombre;
                }
            ],
            // 'peso_max',
            'fecha',
            // 'hora',

            [
                'label' => 'Acciones', 
                'vAlign' => 'middle',
                'value' =>  function($model){
                    return  Html::a('', ['avance-proceso/index', 'id_p'=>$model->id_proceso], ['class' => 'glyphicon glyphicon-forward', 'title'=>'Subir avance']).'&nbsp&nbsp'.
                            Html::a('', ['#', 'id'=>$model->id_proceso], ['class' => 'glyphicon glyphicon-folder-open', 'title'=>'Ver archivos']).'&nbsp&nbsp'.
                            Html::a('', [''], ['class' => 'arch_cas glyphicon glyphicon-open-file', 'title'=>'Subir archivo']).'&nbsp&nbsp'.
                            Html::a('', ['update', 'id'=>$model->id_proceso], ['class' => 'glyphicon glyphicon-pencil', 'title'=>'Actualizar']).'&nbsp&nbsp&nbsp'.
                            Html::a('', ['configuracion', 'id'=>$model->id_proceso], ['class' => Yii::$app->user->can('dir_juridico') ? 'glyphicon glyphicon-cog' : '', 'title'=>'Configuración']).'&nbsp&nbsp'.
                            Html::a('', ['delete', 'id' => $model->id_proceso], ['class' => Yii::$app->user->can('dir_juridico') ? 'glyphicon glyphicon-trash' : '',
                            'data' => [
                                'confirm' => '¿Está seguro que desea borrar este proceso?. Tambien se borrarán los avances y archivos relacionados',
                                'method' => 'post',
                            ],
                            'title'=>'Eliminar',

                        ]);
                },
                'format' => 'raw',
                'options'=>['width'=>'15%'],
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
                $('#folder').attr('value', 'otros');
            });

        });    
    });
</script>