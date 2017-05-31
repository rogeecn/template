<?php

/** @var $this \common\extend\View */
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
        <?php for ($j = 0; $j < 3; $j++): ?>
            <div class="widget border widget-box">
                <h2 class="title">
                    <?= \common\extend\Html::a("Hello", $this->categoryURL("hello")) ?>
                </h2>
                <ul class="body item-list">
                    <?php for ($k = 1; $k < 5; $k++): ?>
                        <li>
                            <time>2017-01-02</time>
                            <a href="/">你你好中国3333你好中国333好中国333333你好中国333好中国33333你好中国333好中国333</a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        <?php endfor; ?>
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
