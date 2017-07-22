<?php

/** @var $this \common\extend\View */
?>

<?= \themes\basic\widgets\CategoryBox::widget([
    'categoryID' => 26,
]);
?>
<div class="clearfix">
    <div class="content">
        <?= \themes\basic\widgets\Carousel\Carousel::widget(['articleType' => 'carousel']) ?>
    </div>
    <div class="sidebar">
        <?= \themes\basic\widgets\Tab\Tab::widget([
            'options' => ['style' => 'height: 200px'],
            'items'   => [
                [
                    'title'   => '网站公告',
                    'content' => \themes\basic\widgets\ListItem::widget([
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
        <?php
        $indexCategories   = array_filter(explode(',', $this->setting("page.index_category")));
        $indexCategoryList = array_chunk($indexCategories, 2);
        ?>
        <?php foreach ($indexCategoryList as $indexCategories): ?>
            <div class="row">
                <div class="col col-left">
                    <?= \themes\basic\widgets\CategoryBox::widget([
                        'categoryAlias' => trim($indexCategories[0]),
                    ]);
                    ?>
                </div>

                <?php if (!empty($indexCategories[1])): ?>
                    <div class="col col-right">
                        <?= \themes\basic\widgets\CategoryBox::widget([
                            'categoryAlias' => trim($indexCategories[1]),
                        ]);
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?= $this->render("sider") ?>
</div>


<?= \themes\basic\widgets\Tab\Tab::widget([
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
