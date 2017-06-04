<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use app\assets\AppAsset;

use app\models\User;

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" type="image/png" href="/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/img/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/img/favicon-96x96.png" sizes="96x96">

    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
            // если гость
            if (Yii::$app->user->isGuest) {
                $menuitems = [
                        ['label' => 'Регистрация', 'url' => ['/site/signup']],
                        ['label' => 'Вход', 'url' => ['/site/login']]
                    ];
            }
            else {
                $menuitems = [
                        ['label' => 'Личный кабинет', 'url' => ['/site/index']],
                        ['label' => 'Отчеты о тренировках', 'url' => ['/site/report']],
                        '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                'Выйти (' . Yii::$app->user->identity->email . ')',
                                ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                        . '</li>'
                    ];
            }

            NavBar::begin([
                'brandLabel' => Html::img('@web/img/logo.png', ['alt' => Yii::$app->name]),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuitems,
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
            <p class="pull-left">&copy; Чемпион <?= date('Y') ?></p>

            <p class="pull-right"></p>
        </div>
    </footer>

    <?php 
        $this->registerJsFile('/js/recall_me.js?v=1.001',  ['position' => yii\web\View::POS_END]);
        $this->registerJsFile('/js/jqBootstrapValidation.js',  ['position' => yii\web\View::POS_END]);
        $this->endBody();
    ?>
</body>
</html>
<?php $this->endPage() ?>