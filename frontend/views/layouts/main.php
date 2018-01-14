<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('common', 'My Blog'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $leftMenus = [
        ['label' => Yii::t('yii','Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('common','Post'), 'url' => ['/post/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $rightMenus[] = ['label' => Yii::t('common','Signup'), 'url' => ['/site/signup']];
        $rightMenus[] = ['label' => Yii::t('common','Login'), 'url' => ['/site/login']];
    } else {
        /*
        $rightMenus[] = '<li>'
            . Html::beginForm(['#'])
            . Html::submitButton('<img src = /statics/images/vartar/small.jpg alt ='. Yii::$app->user->identity->username . '>',
                ['class' => 'btn btn-link logout avatar']
            )
            .'</li>'
            . Html::endForm();
*/

        $rightMenus[] = [
                'label'=>'<li><img src = /statics/images/vartar/small.jpg alt ='. Yii::$app->user->identity->username .'></li>',
                'linkOptions'=>['class'=> 'avatar'],
                'items'=>[
                        ['label' =>'<i class="fa fa-sign-out"></i>退出','linkOptions' =>['data-method' =>'post'],'url' =>['/site/logout']]
                ]
                ];

    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        /*取消标签转码*/
        'encodeLabels' =>false,
        'items' => $rightMenus,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $leftMenus,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
