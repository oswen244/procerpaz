<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\UploadForm;
use yii\web\UploadedFile;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = $model->nombres.' '.$model->apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="text-center"><?= Html::tag('h3', (isset($_GET['m'])) ? $_GET['m'] : '' ,['class'=> 'help-block']);?></div>
<div class="col-md-12">
     <div class="col-md-3">
        <div class="show-image text-center">
            <img style="border-radius:50%; width:70%;" src="<?=Yii::$app->request->baseUrl; ?>/images/perfiles/<?=$model->foto_perfil;?>" alt="perfil">
            <?= Html::a('', ['delete-foto','id'=>$model->id_usuario], ['title'=>'Eliminar foto', 'class' => 'glyphicon glyphicon-remove','data' => [
                    'confirm' => '¿Está seguro que desea eliminar esta foto?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>

           
        <ul class="nav nav-pills nav-stacked">
            <li>
            <?= Html::a('Cambiar foto', ['#'], ['id'=>'foto', 'class' => 'text-center']) ?>
           </li><br>
           <?php if(Yii::$app->user->can('admin')){ ?>
           <li>
            <?= Html::a($model->promotor == 0 ? 'Marcar usuario como promotor' : 'Desmarcar usuario como promotor', [$model->promotor == 0 ? 'marcar-promotor' : 'desmarcar-promotor', 'id' => $model->id_usuario], ['class' => 'text-center',
                    'data' => [
                        'confirm' => $model->promotor == 0 ? '¿Está seguro que desea marcar este usuario como promotor?' : '¿Está seguro que desea desmarcar este usuario como promotor?',
                        'method' => 'post',
                    ],
                ]) ?>
           </li>
           <?php } ?>
           <li>
            <?= Html::a('Listar usuarios', ['index'], ['class' => 'text-center']) ?>
           </li>
           <li>
            <?= Html::a('Actualizar', ['update', 'id' => $model->id_usuario], ['class' => 'text-center']) ?>
           </li><br>
           <?php if(Yii::$app->user->can('admin')){ ?>
           <li>
            <?= Html::a('Eliminar', ['delete', 'id' => $model->id_usuario], [
                'class' => 'text-center',
                'data' => [
                    'confirm' => '¿Está seguro que desea eliminar este usuario?',
                    'method' => 'post',
                ],
            ]) ?>
           </li>
           <?php } ?>
        </ul>
    </div>
    <div class="usuarios-view col-md-9">

        <h1><?= Html::encode($this->title) ?></h1><br>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id_usuario',
                'nombres',
                'apellidos',
                'cargo',
                'telefono',
                'email:email',
                'pais',
                'ciudad',
                'genero',
                'celular',
                'usuario',
                [
                    'attribute'=>'promotor',
                    'value'=>$model->promotor == 0 ? 'No' : 'Si',
                ],
                // 'promotor',
                // 'contrasena',
                // 'perfil',
                // 'estado',
            ],
        ]) ?>

    </div>
</div>
<div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Cambiar imagen</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                     <?= $this->render('upload', [
                        'upload' => new UploadForm(),
                    ]) ?>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
         $('#foto').on('click', function(event) {
            event.preventDefault();
            $('#iu').val('<?=$model->id_usuario;?>');
            $('#imagenModal').modal('show');
        });   
    });
</script>
