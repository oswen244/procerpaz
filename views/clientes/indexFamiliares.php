<script type="text/javascript">
    $(document).ready(function() {
        // $('a[title="View"]').attr('href', 'view-familiar?id=')   
        // $('a[title="Update"]').attr('href', 'update-familiar?id=')   
        // $('a[title="Delete"]').attr('href', 'delete-familiar')
    });
</script>
<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Familiares';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="col-md-12">
    <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
               <li><?= Html::a('Regresar a información de cliente', ['view', 'id' => $id_cliente], ['class' => '']) ?></li>
                <li><a href="index">Listar clientes</a></li>
            </ul>
        </div>
    <div class="familiares-index col-md-9">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id_familiar',
                'id_cliente',
                // 'num_afiliacion',
                // 'fecha_afiliacion',
                'nombres',
                'apellidos',
                // 'tipo_id',
                'num_id',
                'genero',
                'parentezco',
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

                // [
                //     'class' => '\kartik\grid\ActionColumn',
                //     'viewOptions' => ['label' => '<i class="ver glyphicon glyphicon-eye-open"></i>'],
                //     'updateOptions' => ['label' => '<i class="act glyphicon glyphicon-pencil"></i>'],
                //     'deleteOptions' => ['label' => '<i class="del glyphicon glyphicon-trash"></i>']

                // ],

                [
                    'label' => 'Actions', 
                    'vAlign' => 'middle',
                    'value' =>  function($data){
                        return  Html::a('', ['view-familiar', 'id'=>$data->id_familiar, 'idc'=>$data->id_cliente], [
                            'class' => 'glyphicon glyphicon-eye-open', 
                        ]).'&nbsp'.Html::a('', ['update-familiar', 'id'=>$data->id_familiar, 'idc'=>$data->id_cliente], [
                            'class' => 'act glyphicon glyphicon-pencil', 
                        ]);
                    },
                    'format' => 'raw',
                    
                ],
            ],
            // [
            //     'class' => 'kartik\grid\ExpandRowColumn',
            //     'value' => function ($model, $key, $index, $column) {
            //         return GridView::ROW_COLLAPSED;
            //     },
            //     'detail' => function ($model, $key, $index, $column) {
            //         return Yii::$app->controller->renderPartial('_expand-row-details', ['model'=>$model]);
            //     }, 
            //     // uncomment below and comment detail above to load via ajax
            //     // 'detailUrl' => Url::to(['/book/show-detail'])
            // ],
            'toolbar' => [
                ['content'=>
                    Html::a('Agregar familiar', ['create-familiares', 'id' => $id_cliente], ['class' => 'btn btn-success'])
                    // Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Agregar cliente', 'class'=>'btn btn-success', 'onclick'=>'create.php']) 
                ],
                '{export}',
                // '{toggleData}',
            ],
            'hover' => true,
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => '<i class="glyphicon glyphicon-user"></i>  Familiares',
            ],
        ]); ?>

    </div>
</div>
