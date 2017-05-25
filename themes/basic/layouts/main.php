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
<?= $this->render("_header") ?>

<section class="container">
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
