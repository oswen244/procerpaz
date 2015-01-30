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
		</div>
	</div>
</div>
