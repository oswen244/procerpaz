<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PagosAuxiliosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Auxilios', 'url' => ['auxilios/indexdes']];
$this->title = 'Pagos Auxilios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li><?= Html::a('Regresar', ['auxilios/indexdes'], ['class' => '']) ?></li>
        </ul>
    </div>
    <div class="pagos-auxilios-index col-md-9">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id_pago',
                'monto',
                'fecha',
                // 'id_auxilio',

                [
                    'label' => '', 
                    'vAlign' => 'middle',
                    'value' =>  function($data){
                        return  Html::a('', ['update', 'id'=>$data->id_pago, 'id_auxilio'=>$_GET['id_auxilio'], 'cuota' => $_GET['monto']], ['class' => 'act glyphicon glyphicon-pencil', 'title'=>'Editar']).'&nbsp'.
                                Html::a('', ['delete', 'id' => $data->id_pago, 'id_auxilio'=>$_GET['id_auxilio'], 'cuota' => $_GET['monto']], ['class' => 'act glyphicon glyphicon-trash',
                                'data' => [
                                    'confirm' => '¿Está seguro que desea borrar este auxilio?',
                                    'method' => 'post',
                                ],
                                'title'=>'Eliminar',

                            ]);
                         },
                    'format' => 'raw',
                    'options'=>['width'=>'7%'],
                ],
            ],
            'toolbar' => [
                ['content'=>
                    Html::a('Agregar pago', ['create', 'cuota' => $_GET['monto'], 'id_auxilio'=>$_GET['id_auxilio']], ['class' => 'btn btn-success'])
                ],
                '{export}',
            ],
            'hover' => true,
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => '<i class="glyphicon glyphicon-usd"></i>  Pagos de auxilios ',
            ],
        ]); ?>

    </div>
</div>
