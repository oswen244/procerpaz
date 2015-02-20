<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'text-center'],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id_cliente',
            'num_afiliacion',
            'fecha_afiliacion',
            'nombres',
            'apellidos',
            // 'tipo_id',
            'num_id',
            // 'genero',
            // 'lugar_exp',
            // 'fecha_nacimiento',
            // 'grado',
            // 'pais',
            // 'ciudad',
            // 'email:email',
            // 'direccion',
            // 'telefono',
            // 'id_institucion',
            // 'id_planilla',
            // 'id_estado',
            // 'monto_paquete',
            [
                'attribute' => 'monto_paquete',
                'value' => function($data){ return "$ ".number_format($data->monto_paquete,0);}
            ],
            // [
            //     'attribute'=>'id_estado',
            //     'value'=> function($model){ return $model->idEstado->nombre;}
            // ],
            [
                'attribute'=>'estado',
                'value'=> 'idEstado.nombre',
            ],
            // 'observaciones',

            ['class' => '\kartik\grid\ActionColumn'],
        ],
       
        'toolbar' => [
            ['content'=>
                Html::a('Crear cliente', ['create'], ['class' => 'btn btn-success'])
            ],
            '{export}',
            // '{toggleData}',
        ],
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-user"></i>  Clientes',
        ],
    ]); ?>

</div>
