<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PagosPrestamos */

$this->title = 'Agregar pagos';
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['prestamos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Pagos Prestamos', 'url' => ['index','id_prestamo'=>$id_prestamo]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
     <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
           <li>
            <?= Html::a('Regresar', ['index','id_prestamo'=>$id_prestamo], ['class' => '']) ?>
           </li>
        </ul>
    </div>
    <div class="pagos-prestamos-create col-md-9">

        <h1><?= Html::encode($this->title) ?></h1><br>

        <?= $this->render('_form', [
            'model' => $model,
            'id_prestamo'=>$id_prestamo,
            'resto'=>$resto,
            'cuota'=>$cuota,
        ]) ?>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#pagosprestamos-capital').val('<?=$resto?>');
        $('#pagosprestamos-valor_cuota').on('change',  function(event) {
            event.preventDefault();
            var valor_nuevo = $(this).val();
            $('#pagosprestamos-amortizacion').val(valor_nuevo-'<?=$cuota["interes"];?>');            
            if(valor_nuevo === '<?=$cuota["valor_cuota"]?>'){
                $('#pagosprestamos-capital').val('<?=$resto-($cuota["valor_cuota"]-$cuota["interes"])?>')
            }else{
                $('#pagosprestamos-capital').val($('#pagosprestamos-capital').val()-$('#pagosprestamos-amortizacion').val())
            }
        });
    });
</script>
