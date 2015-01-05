<?php 
	use yii\helpers\Html;
	use yii\widgets\DetailView;
	use app\models\Promotores;
	use kartik\grid\GridView;
 ?>

<div class="row text-center">
	<h3>FUNDACIÓN PROSERPAZ</h3> 
	<h5>Projected Service For Peace S.A.S</h5>
	<h4>DIRECCIÓN DE PROMOCIÓN Y DIVULGACIÓN</h4>
	<h4>PLANILLA DE REPORTE DE AFILIACIONES</h4>
	<h3>Planilla N°: <span><?=$model->id_planilla;?><span></h3>
</div>
<div class="col-lg-12">
	<?= DetailView::widget([
	    'model' => $model,
	    'attributes' => [
	        // 'id_planilla',
	        'fecha',
	        'lugar',
	        'unidad',
	        // 'comision_afiliado',
	        // [
	        //     'attribute' => 'comision_afiliado',
	        //     'value' => "$ ".number_format($model->comision_afiliado,0)
	        // ],
	        // // 'por_ant_com',
	        // [
	        //     'attribute' => 'por_ant_com',
	        //     'value' => $model->por_ant_com."%",
	        // ],
	       
	    ],
	]) ?>
</div>

<div class="col-lg-12">
	<?= GridView::widget([
            'dataProvider' => $promotores, //REVISAR
            // 'filterModel' => $searchModelLista,
            'pjax'=>true,
            'rowOptions' => ['class' => 'text-center'],
            'columns' => [
                
                ['class' => 'yii\grid\SerialColumn'],

                'nombres',
                'apellidos',
             ],
            
        ]); ?>
</div>

<div class="col-lg-12">
	<?= GridView::widget([
            'dataProvider' => $afiliados,
            // 'filterModel' => $searchModelLista,
            'pjax'=>true,
            'rowOptions' => ['class' => 'text-center'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

	            // 'id_cliente',
	            // 'num_afiliacion',
	            [
	            	'attribute'=>'num_afiliacion',
	            	'label'=>'N° afiliación'
	            ],
	            'nombres',
	            'apellidos',
	            // 'tipo_id',
	            // 'num_id',
	            [
	            	'attribute'=>'num_id',
	            	'label'=>'N° de ID'
	            ],
	            // 'id_institucion',
	            [
	            	'attribute'=>'id_institucion',
	            	'label'=>'Entidad'
	            ],
	            // 'fecha_afiliacion',
	            [
	            	'attribute'=>'fecha_afiliacion',
	            	'label'=>'Afiliación'
	            ],
	            // 'fecha_rep',
	            [
	            	'attribute'=>'fecha_rep',
	            	'label'=>'Reporte'
	            ],
	            // 'monto_paquete',
	            // [
	            //     'attribute' => 'monto_paquete',
	            //     'value' => function($data){ return "$ ".number_format($data->monto_paquete,0);}
	            // ],
	            'observaciones',

                ],
            
        ]); ?>
</div>
