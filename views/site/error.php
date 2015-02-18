<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <div class="">
        <h1><?= Html::encode($code === 403 ? 'Oops!... Acceso denegado' : $this->title) ?></h1>
    </div>
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <?php if ($code === 403){ ?>
        <p><img src="../images/forbidden.png" alt="prohibido" width="20%"></p>
    <?php } ?>

    
    <p>
        Este error ocurrió mientras se procesaba su solicitud.
        Por favor contacte al administrador si tiene alguna inquietud. Gracias.
    </p>
    
    <p><a onclick="goBack()" class="btn btn-success glyphicon glyphicon-backward"> Volver</a></p>

</div>
<script type="text/javascript">
    function goBack() {window.history.back()};
</script>