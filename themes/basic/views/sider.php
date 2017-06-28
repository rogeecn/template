<aside class="sidebar">
    <?php /*= \themes\basic\widgets\Tab\Tab::widget([
        'items' => [
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
    ]); */ ?>

    <?php /*= \themes\basic\widgets\BlockShow\BlockShow::widget(['id' => 23]); */ ?>
    <?php /*= \themes\basic\widgets\BlockShow\BlockShow::widget(['id' => 24]); */ ?>

    <?= \themes\basic\widgets\TagCloud\TagCloud::widget([
        'items' => \common\models\Tag::getList(18, TRUE),
    ]) ?>
</aside>
