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

<?php for ($j = 0; $j < 2; $j++): ?>
    <div class="row">
        <?php for ($i = 0; $i < 3; $i++): ?>
            <div class="box">
                <div class="widget border">
                    <h2 class="title">
                        <?= \common\extend\Html::a("Hello", $this->categoryURL("hello")) ?>
                    </h2>
                    <ul class="body">
                        <?php for ($k = 1; $k < 15; $k++): ?>
                            <li>
                                <time>2017-01-02</time>
                                <a href="/">你你好中国3333你好中国333好中国333333你好中国333好中国33333你好中国333好中国333</a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
        <?php endfor; ?>
    </div>
<?php endfor; ?>



<?= \widgets\Tab\Tab::widget([
    'options'   => ['style'=>"margin-top: 20px;"],
    'items'   => [
        [
            'title'   => '友情链接',
            'content' => 'hello 友情链接!',
        ],
        [
            'title'   => '合作伙伴',
            'content' => 'hello 合作伙伴!',
        ],
    ],
]); ?>
