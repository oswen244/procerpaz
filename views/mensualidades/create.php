<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mensualidades */

$this->title = 'Create Mensualidades';
$this->params['breadcrumbs'][] = ['label' => 'Mensualidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensualidades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
