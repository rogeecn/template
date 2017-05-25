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
<section class="container">

    <div class="row">
        <?php for ($i = 0; $i < 3; $i++): ?>
            <div class="box" >
                <?= \widgets\Tab\Tab::widget([
                    'items' => [
                        [
                            'title'   => '网站公告',
                            'content' => \widgets\ListItem::widget([
                                'items' => function () {
                                    $dataList = \common\models\Article::getListByCategoryAlias("announcement");

                                    $items = [];
                                    foreach ($dataList as $data) {
                                        $items[] = [
                                            'title' => $data['title'],
                                            'url'   => \yii\helpers\Url::to(['article/id', 'id' => $data['id']]),
                                            'time'  => date("Y-m-d", $data['created_at']),
                                        ];
                                    }

                                    return $items;
                                },
                            ]),
                        ],
                    ],
                ]); ?>
            </div>
        <?php endfor; ?>
    </div>

    <div class="content">
        <?= $content ?>
    </div>

    <aside class="sidebar">
        <?= \widgets\Tab\Tab::widget([
            'items' => [
                [
                    'title'   => '网站公告',
                    'content' => \widgets\ListItem::widget([
                        'items' => function () {
                            $dataList = \common\models\Article::getListByCategoryAlias("announcement");

                            $items = [];
                            foreach ($dataList as $data) {
                                $items[] = [
                                    'title' => $data['title'],
                                    'url'   => \yii\helpers\Url::to(['article/id', 'id' => $data['id']]),
                                    'time'  => date("Y-m-d", $data['created_at']),
                                ];
                            }

                            return $items;
                        },
                    ]),
                ],
            ],
        ]); ?>

        <?= \widgets\BlockShow\BlockShow::widget(['id' => 23]); ?>
        <?= \widgets\BlockShow\BlockShow::widget(['id' => 24]); ?>

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
