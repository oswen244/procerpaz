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
                    [
                        'label' => 'Clientes',
                        'items' => [
                            ['label' => 'Listar clientes', 'url' => ['/clientes/index']],                            
                            ['label' => 'Planillas', 'url' => ['/planillas/index']],
                            ['label' => 'Promotores', 'url' => ['/promotores/index']],                            
                            ['label' => 'Instituciones', 'url' => ['/instituciones/index']],                            
                        ],

                    ],
                    ['label' => 'Auxilios',
                        'items' => [
                            ['label' => 'Auxilio de desempleo', 'url' => ['/auxilios/indexdes']],                            
                            ['label' => 'Auxilio exequial', 'url' => ['/auxilios/indexexe']],
                        ],

                    ],

                    ['label' => 'Cartera', 
                        'items' => [
                            ['label' => 'Exportar descuentos', 'url' => ['/cartera/indexex']],                            
                            ['label' => 'Actualizar descuentos', 'url' => ['#']],
                        ],
                    ],

                    ['label' => 'Jurídico', 
                        'items' => [
                            ['label' => 'Listar casos', 'url' => ['proceso-juridico/index']],                            
                            ['label' => 'Gestión de avances', 'url' => ['#']],
                        ],
                    ],
                    
                    ['label' => 'Prestamos', 'url' => ['/prestamos/index']],
                    
                    ['label' => 'Usuarios', 
                        'items' => [
                            ['label' => 'Listar usuarios', 'url' => ['/usuarios/index']],                            
                            ['label' => 'Perfiles', 'url' => ['/items/index']],
                            ['label' => 'Salir (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                        ],
                    ],
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
