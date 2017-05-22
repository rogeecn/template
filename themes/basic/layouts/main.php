<?php

/* @var $this \common\extend\View */
/* @var $content string */

use application\assets\AppAsset;
use common\extend\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header class="nav">
    <div class="container">
        <?= \widgets\NavItem::widget([
            'items'            => \common\models\LinkGroup::getLinkByGroupAlias("nav-top"),
            'containerOptions' => ['class' => 'menu nav-sub text-right'],
        ]) ?>
        <div class="nav-main text-right">
            <h1 class="logo">
                <?php
                $logoImg  = Html::img($this->setting("site.logo"));
                $siteName = $this->setting("site.name");
                $siteUrl  = $this->setting("site.url");
                echo Html::a($logoImg . $siteName, $siteUrl);
                ?>
            </h1>
            <div class="brand">
                <?= strtr($this->setting("site.slogan"), [',' => '<br>']) ?>
            </div>
            <?= \widgets\NavItem::widget([
                'items'   => \common\models\LinkGroup::getLinkByGroupAlias("nav-main"),
                'options' => ['class' => 'menu nav-menu'],
            ]) ?>
        </div>
    </div>
</header>
<section class=" container site-body">
    <div class="content">
        <?= $content ?>
    </div>

    <aside class="sidebar">
        <?= \widgets\Tab\Tab::widget([
            'items' => [
                [
                    'title'   => '网站公告',
                    'content' => $this->render("_tab_content"),
                ],
            ],
        ]); ?>

        <?= \widgets\BlockShow\BlockShow::widget([
            'band'       => '推荐',
            'tagOptions' => [
                'href' => \yii\helpers\Url::to(['/recommend']),
            ],
            'title'      => 'DUX主题 新一代主题',
            'content'    => 'DUX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而成；更加扁平的风格和干净白色的架构会让网站显得内涵而出色...',
        ]) ?>

        <?= \widgets\BlockShow\BlockShow::widget([
            'band'       => '推荐',
            'style'      => 'style02',
            'tagOptions' => [
                'href' => \yii\helpers\Url::to(['/recommend']),
            ],
            'title'      => 'DUX主题 新一代主题',
            'content'    => 'DUX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而成；更加扁平的风格和干净白色的架构会让网站显得内涵而出色...',
        ]) ?>

        <?= \widgets\TagCloud\TagCloud::widget([
            'items' => \common\models\Tag::getList(18, true),
        ]) ?>
    </aside>
</section>
<?= \widgets\ColumnShow::widget([
    'title' => 'themebetter 国内更好的WordPress主题服务商',
    'link'  => [
        'label' => '立即前往',
        'url'   => '/gogogo',
    ],
    'style' => 'gray',
]) ?>

<footer class="footer">
    <div class="container text-center">
        <p>
            <span>© <?= date("Y") ?></span>&nbsp;
            <?= Html::a($this->setting("site.name"), $this->setting("site.url")) ?>&nbsp;
            <?= $this->ICPNumber() ?>&nbsp;
            <?= $this->PoliceNumber() ?>
        </p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
