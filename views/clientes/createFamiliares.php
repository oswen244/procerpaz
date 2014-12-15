<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Familiares */

$this->title = 'Create Familiares';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Familiares', 'url' => ['familiares?id='.$id_cliente]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="familiares-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formFamiliares', [
        'familiar' => $familiar,
    ]) ?>

</div>
