<?php

/* @var $this \yii\web\View */
/* @var $content string */

use application\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>YCms</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= \widgets\Header\Header::widget([
    'logo'    => [
        'title' => '大前端',
        'image' => 'http://www.daqianduan.com/wp-content/uploads/2015/01/logo.png',
        'url'   => '/',
    ],
    'brand'   => '关注前端开发,关注用户体验',
    'subNav'  => [
        ['label' => '联系大前端', 'url' => '/'],
        ['label' => '联系大前端', 'url' => '/'],
        ['label' => '联系大前端', 'url' => '/'],
        ['label' => '联系大前端', 'url' => '/'],
    ],
    'mainNav' => [
        ['label' => '首页', 'url' => '/'],
        ['label' => '前端开发', 'url' => '/', 'items' => [
            ['label' => '前端开发', 'url' => '/'],
            ['label' => '设计', 'url' => '/'],
            ['label' => '前端网址导航', 'url' => '/'],
            ['label' => '前端招聘', 'url' => '/'],
        ]],
        ['label' => '设计', 'url' => '/'],
        ['label' => '前端网址导航', 'url' => '/'],
        ['label' => '前端招聘', 'url' => '/'],
        ['label' => 'WordPress主题', 'url' => '/'],
    ],
]) ?>
<section class="container site-body">
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
            'items' => [
                '招聘/求职 (110)',
                '招聘/求职 (110)',
                '招聘/求职 (110)',
                '招聘/求职 (110)',
                '招聘/求职 (110)',
                '招聘/求职 (110)',
                '招聘/求职 (110)',
                '招聘/求职 (110)',
                '招聘/求职 (110)',
                '招聘/求职 (110)',
                '招聘/求职 (110)',
            ],
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
        <p>© 2017 大前端 本站DUX主题由 themebetter.com 提供 <a href="">网站地图</a></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
