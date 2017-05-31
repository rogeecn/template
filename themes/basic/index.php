<?php

/** @var $this \common\extend\View */

$allowTags                  = 'h1,h2,h3,h4,h5';
echo "\n\n-----------------------\n\n";
echo  \yii\helpers\HtmlPurifier::process($this->render("_html"), [
    'HTML.Allowed' => $allowTags,
]);
echo "\n\n-----------------------\n\n";
?>
<div class="clearfix">
    <div class="content">
        <?= \widgets\Carousel\Carousel::widget(['articleType' => 'carousel']) ?>
    </div>
    <div class="sidebar">
        <?= \widgets\Tab\Tab::widget([
            'options' => ['style' => 'height: 200px'],
            'items'   => [
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
</div>

<div class="clearfix">
    <div class="content">
        <?= \widgets\CategoryBox::widget(['categoryAlias' => 'html-css']) ?>
        <?= \widgets\CategoryBox::widget(['categoryAlias' => 'php']) ?>
    </div>

    <?= $this->render("sider") ?>
</div>


<?= \widgets\Tab\Tab::widget([
    'options' => ['style' => "margin-top: 20px;"],
    'items'   => [
        [
            'title'   => '友情链接',
            'content' => function () {
                $linkList = \common\models\LinkGroup::getLinkByGroupAlias("friendlink");

                $items = [];
                foreach ($linkList as $item) {
                    $items[] = \common\extend\Html::a($item['label'], $item['url'], ['target' => "_blank"]);
                }

                return \common\extend\Html::div(implode("\n", $items), ['class' => 'friendlink-list']);
            },
        ],
    ],
]); ?>
