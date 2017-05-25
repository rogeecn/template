<?php
/** @var $this \common\extend\View */
?>
<div class="row">
    <?php for ($i = 0; $i < 3; $i++): ?>
        <div class="box">
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

