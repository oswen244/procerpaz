<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Promotores;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Planillas */

$this->title = 'Planilla N° '.$model->id_planilla;
$this->params['breadcrumbs'][] = ['label' => 'Planillas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
     <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Listar planillas', ['index'], ['class' => '']) ?></li>
           <li><?= Html::a('Actualizar', ['update', 'id' => $model->id_planilla], ['class' => '']) ?></li>
           <li><a href="#" id="prom">Asignar promotores</a></li><br>
           <li>
               <?= Html::a('Eliminar', ['delete', 'id' => $model->id_planilla], [
                    'class' => '',
                    'data' => [
                        'confirm' => '¿Está seguro que desea eliminar esta planilla?',
                        'method' => 'post',
                    ],
                ]) ?>
            </li>
        </ul>
    </div>
    <div class="planillas-view col-md-9">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id_planilla',
                'fecha',
                'lugar',
                'unidad',
                // 'comision_afiliado',
                [
                    'attribute' => 'comision_afiliado',
                    'value' => "$ ".number_format($model->comision_afiliado,0)
                ],
                // 'por_ant_com',
                [
                    'attribute' => 'por_ant_com',
                    'value' => $model->por_ant_com."%",
                ],
               
            ],
        ]) ?>

        <div class="row">
            <div class="promotores_planillas-index">

                <?= GridView::widget([
                    'dataProvider' => $dataProviderLista,
                    // 'filterModel' => $searchModelLista,
                    'pjax'=>true,
                    'rowOptions' => ['class' => 'text-center'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id_promotor',
                        [
                            'attribute' => 'id_promotor',
                            'label'=>'Nombres',
                            'value' => function($model){
                                return $model->idPromotor->nombres;
                            },
                        ],
                        [
                            'attribute' => 'id_promotor',
                            'label'=>'Apellidos',
                            'value' => function($model){
                                return $model->idPromotor->apellidos;
                            },
                        ],
                        // 'id_planilla',

                        [
                            'label' => '', 
                            'vAlign' => 'middle',
                            'value' =>  function($data){
                                return  Html::a('', ['promotores/view', 'id'=>$data->id_promotor], ['class' => 'glyphicon glyphicon-eye-open',]).'&nbsp'.
                                        Html::a('', ['promotores-planillas/delete', 'id_planilla'=>$data->id_planilla, 'id' => $data->id_promotores_planillas], ['class' => 'glyphicon glyphicon-trash',
                                        'data' => [
                                            'confirm' => 'Está seguro que desea desvincular este promotor?',
                                            'method' => 'post',
                                        ]
                                    ]);
                            },
                            'format' => 'raw',
                            
                            ],

                        ],

                    'hover' => true,
                    'panel' => [
                        // 'type' => GridView::TYPE_DEFAULT,
                        'heading' => '<i class="glyphicon glyphicon-user"></i>  Promotores asignados',
                    ],
                ]); ?>

            </div>
        </div>
    </div>
</div>


<div id="promotoresModal" class="modal fade bs-example-modal-sm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Promotores</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="planillas-index">

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'rowOptions' => ['class' => 'text-center'],
                            'id' => 'promList',
                            'columns' => [
                                // ['class' => 'yii\grid\SerialColumn'],

                                ['class' => 'kartik\grid\CheckboxColumn'],
                                // 'id_promotor',
                                'nombres',
                                'apellidos',

                            ],

                            'hover' => true,
                            'panel' => [
                                // 'type' => GridView::TYPE_DEFAULT,
                                'heading' => '<i class="glyphicon glyphicon-user"></i>  Promotores',
                            ],
                        ]); ?>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="asignar" class="btn btn-primary" data-dismiss="modal">Asignar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#prom').on('click', function(event) {
            event.preventDefault();
            $('#promotoresModal').modal({backdrop:'static'});
        });
        $('#asignar').on('click', function(event){
            event.preventDefault();
            var data = {};
            data[0] = $('#promList').yiiGridView('getSelectedRows');//Obtener los valores de la tabla
            data[1] = <?=$model->id_planilla;?>;
            // console.log(data);
            $.post('asignar', {data: data}).done(function(data) {
                alert(data);
            });

            
        });
    });
</script>