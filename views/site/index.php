<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Página principal';
?>
<div class="site-index">
    <!-- <h1>Proserpaz página de inicio</h1> -->
    <h1>Bienvenido <span><?= Yii::$app->user->identity->username; ?></span></h1><br>
	<div class="panel panel-default">
		<div class="panel-heading"><h3>Novedades!</h3></div>
	    <div class="panel-body">
		    <p><?= Html::a('Obsequios vencidos: ', ['obsequios/index'], ['class' => '']) ?><span><?=$obsequios;?></span></p>
		    <p><?= Html::a('Clientes desafiliados: ', ['clientes/index?ClientesSearch%5Bplanilla%5D=&ClientesSearch%5Bnum_afiliacion%5D=&ClientesSearch%5Bfecha_afiliacion%5D=&ClientesSearch%5Bnombres%5D=&ClientesSearch%5Bapellidos%5D=&ClientesSearch%5Bnum_id%5D=&ClientesSearch%5Bmonto_paquete%5D=&ClientesSearch%5Bestado%5D=desafiliado'], ['class' => '']) ?><?=$desafil;?></span></p>
		    <p><?= Html::a('Clientes en mora: ', ['clientes/index?ClientesSearch%5Bplanilla%5D=&ClientesSearch%5Bnum_afiliacion%5D=&ClientesSearch%5Bfecha_afiliacion%5D=&ClientesSearch%5Bnombres%5D=&ClientesSearch%5Bapellidos%5D=&ClientesSearch%5Bnum_id%5D=&ClientesSearch%5Bmonto_paquete%5D=&ClientesSearch%5Bestado%5D=mora'], ['class' => '']) ?><?=$mora;?></span></p>
		</div>
	</div>
</div>
