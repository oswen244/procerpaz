<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PagosAuxilios */

$this->title = 'Create Pagos Auxilios';
$this->params['breadcrumbs'][] = ['label' => 'Pagos Auxilios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagos-auxilios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
