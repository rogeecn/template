<?php

/** @var $this \common\extend\View */
/** @var $categoryChildren \common\models\Category[] */
?>
<?= \widgets\Breadcrumbs::widget(['categoryID' => $categoryID]) ?>

<div class="content">
    <?= \widgets\ArticleList\ArticleList::widget([
        'condition' => ['type' => 2, 'category_id' => $categoryID],
        'title'     => [
            'title' => $categoryInfo['name'],
            'more'  => [
                //'label' => 'themebetter 国内更好的WordPress主题服务商',
                //'url'   => ["/"],
            ],
        ],
    ])
    ?>
</div>
<?= $this->render("sider") ?>

