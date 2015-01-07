
<?php 
	use yii\helpers\Html;
	use yii\widgets\DetailView;
	use app\models\Promotores;
	use app\models\GastosPlanillas;
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
            'dataProvider' => $promotores,
            // 'filterModel' => $searchModelLista,
            'rowOptions' => ['class' => 'text-center'],
            'columns' => [
                
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'id_promotor',
                    'label'=>'Promotores',
                    'value' => function($model){
                        return $model->idPromotor->nombres.' '.$model->idPromotor->apellidos;
                    },
                ],

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
	            	'label'=>'Entidad',
	            	'value' => function($model){
	            		return $model->idInstitucion->nombre;	
	            	} 
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

<div class="col-lg-12">
	<?= GridView::widget([
            'dataProvider' => $promotores,
            // 'filterModel' => $searchModelLista,
            'rowOptions' => ['class' => 'text-center'],
            'columns' => [
                
                // ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'id_promotor',
                    'label'=>'Nombre',
                    'value' => function($model){
                        return $model->idPromotor->nombres.' '.$model->idPromotor->apellidos;
                    },
                    'pageSummary' => 'Total',
                ],
                [

                	'attribute'=>'gastos_promotor',
                	'label'=>'Gastos del promotor',
                	'pageSummary' => true
                ],

             ],
             'showPageSummary' => true,
            'panel' => ['heading' => '<i class="glyphicon glyphicon-usd"></i>  Gastos por promotor'],
            'toolbar'=>[]

        ]); ?>
</div>

<div class="col-lg-12">
	<?= GridView::widget([
            'dataProvider' => $gastos_planilla,
            // 'filterModel' => $searchModelLista,
            'rowOptions' => ['class' => 'text-center'],
            'pjax'=>true,
            'columns' => [

                // 'id_gastos_planillas',
                // 'valor',
                // 'fuente',
                // 'asumido_por',
                [
                	'attribute'=>'asumido_por',
                	'pageSummary' => 'Total',
                ],

                'Detalle',
                [
                    'attribute' => 'valor',
                    'pageSummary' => true,
                ],
               'fuente',
                // 'id_planilla',

                // ['class' => 'yii\grid\ActionColumn'],
               
            ],
             'showPageSummary' => true,
            'panel' => ['heading' => '<i class="glyphicon glyphicon-usd"></i> Otros gastos'],
            'toolbar'=>[]

        ]); ?>
</div>

<div class="col-md-12">
	<?php 
		$totalAfiliados = $afiliados->getTotalCount();
		$comisionAfiliacion = $model->comision_afiliado;
		$gastosPromotor = number_format($totalGastosProm);
		$otrosGastos = number_format($totalGastosOtrosProm);
		$totalGastos = $totalGastosProm+$totalGastosOtrosProm;
		$valorComisiones = $comisionAfiliacion*$totalAfiliados;
		$valorTotal = $valorComisiones-$totalGastos;
	 ?>

	<h4>Liquidación</h4>
	<p>Total afiliados: <span><?= $totalAfiliados;?></span></p>
	<p>Comisión por afiliación: <span>$</span><?=$comisionAfiliacion;?></p>
	<p>Gastos de promotores: <span>$</span><?=$gastosPromotor;?></p>
	<p>Otros gastos de promotores: <span>$</span><?=$otrosGastos;?></p><br>

	<p>Total gastos: <span>$</span><?=number_format($totalGastos);?></p>
	<p>Valor comisiones: <span>$</span><?=number_format($valorComisiones);?></p>
	<p>Valor total (comisiones-gastos): <span>$</span><?=number_format($valorTotal)?></p><br>
</div>

<div class="col-md-12">
	<?= GridView::widget([
            'dataProvider' => $promotores,
            // 'filterModel' => $searchModelLista,
            'rowOptions' => ['class' => 'text-center'],
            'columns' => [
                
                [
                    'attribute' => 'id_promotor',
                    'label'=>'Promotor',
                    'value' => function($model){
                        return $model->idPromotor->nombres.' '.$model->idPromotor->apellidos;
                    },
                ],

                [
                	'label'=>'Monto',
                	'contentOptions'=>['class'=>'monto'],
                ],

               
             ],
            'panel' => ['heading' => '<i class="glyphicon glyphicon-usd"></i> A favor de'],
            'toolbar'=>[]
            
        ]); ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.monto').html('<span>$<?=number_format($valorTotal/$promotores->getTotalCount());?></span>');
	});
</script>


