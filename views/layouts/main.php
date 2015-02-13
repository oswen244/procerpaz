<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" charset="utf8" src="<?= Yii::$app->request->baseUrl; ?>/js/jquery.min.js"></script>
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Proserpaz',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-default navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [ 
                    // ['label' => 'Inicio', 'url' => ['/site/index']],
                Yii::$app->user->can('admin') || Yii::$app->user->can('leer_clientes') || Yii::$app->user->can('leer_planillas') || Yii::$app->user->can('leer_promotores') || Yii::$app->user->can('leer_instituciones') ? 
                    [
                        'label' => 'Clientes',
                        'items' => [
                        Yii::$app->user->can('leer_clientes') ?
                            ['label' => 'Listar clientes', 'url' => ['/clientes/index']] : '',
                        Yii::$app->user->can('leer_planillas') ?                          
                            ['label' => 'Planillas', 'url' => ['/planillas/index']] : '',
                        Yii::$app->user->can('leer_promotores') ?
                            ['label' => 'Promotores', 'url' => ['/promotores/index']] : '',
                        Yii::$app->user->can('leer_instituciones') ?                        
                            ['label' => 'Instituciones', 'url' => ['/instituciones/index']] : '',                            
                        ],

                    ] : '',
                Yii::$app->user->can('admin') || Yii::$app->user->can('leer_auxilio_des') || Yii::$app->user->can('leer_auxilio_exe') ? 
                    ['label' => 'Auxilios',
                        'items' => [
                            Yii::$app->user->can('leer_auxilio_des') ?
                            ['label' => 'Auxilio de desempleo', 'url' => ['/auxilios/indexdes']] : '',
                            Yii::$app->user->can('leer_auxilio_exe') ?
                            ['label' => 'Auxilio exequial', 'url' => ['/auxilios/indexexe']] : '',
                        ],

                    ] : '',
                Yii::$app->user->can('admin') ?
                    ['label' => 'Cartera', 
                        'items' => [
                            ['label' => 'Exportar descuentos', 'url' => ['/cartera/indexex']],                            
                            ['label' => 'Actualizar descuentos', 'url' => ['/cartera/indexim']],
                        ],
                    ] : '',

                Yii::$app->user->can('leer_proc_jur') ?
                    ['label' => 'Jurídico', 
                        'items' => [
                            ['label' => 'Listar casos', 'url' => ['proceso-juridico/index']],
                            Yii::$app->user->can('dir_juridico') ? 
                            ['label' => 'Listar Abogados', 'url' => ['proceso-juridico/abogados']] : '',
                        ],
                    ] : '',
                    
                Yii::$app->user->can('leer_prestamos') ?    
                    ['label' => 'Prestamos', 'url' => ['/prestamos/index']] : '',

                Yii::$app->user->can('admin') ?  
                    ['label' => 'Usuarios', 
                        'items' => [
                            ['label' => 'Listar usuarios', 'url' => ['/usuarios/index']],                            
                            ['label' => 'Perfiles', 'url' => ['/items/index']],
                            
                        ],
                    ] : '',

                ['label' => 'Salir (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; PROSERPAZ S.A. <?= date('Y') ?></p>
            <p class="pull-right">Powered by <a href="http://www.elecsis.com.co">Elecsis</a></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
