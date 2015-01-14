<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = 'Crear perfil';
$this->params['breadcrumbs'][] = ['label' => 'Perfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-create">

    <h1><?= Html::encode($this->title) ?></h1><br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

