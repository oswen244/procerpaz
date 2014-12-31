<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Promotores */

$this->title = 'Registrar Promotores';
$this->params['breadcrumbs'][] = ['label' => 'Promotores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-3">
	    <ul class="nav nav-pills nav-stacked">
	       <li>
				<?= Html::a('Regresar', ['index'], ['class' => '']) ?>
	       </li>
	    </ul>
</div>
<div class="promotores-create col-md-9">

	    <h1><?= Html::encode($this->title) ?></h1><br>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

	</div>
</div>
