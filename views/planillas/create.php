<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Planillas */

$this->title = 'Create Planillas';
$this->params['breadcrumbs'][] = ['label' => 'Planillas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planillas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
