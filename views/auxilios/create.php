<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Auxilios */

$this->title = 'Create Auxilios';
$this->params['breadcrumbs'][] = ['label' => 'Auxilios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auxilios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
