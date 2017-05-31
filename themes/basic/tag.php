<?php

/** @var $this \common\extend\View */
$tagArticleIDList = \common\models\TagArticle::getTagArticleIDList($tagInfo['id'], \common\util\Request::input("page"));
$tagTotalCount    = \common\models\TagArticle::getTagArticleCount($tagInfo['id']);
?>
<?= \widgets\Breadcrumbs::widget(['categoryID' => 0, 'text' => $tagName]) ?>
<div class="content">
    <?= \widgets\ArticleList\ArticleList::widget([
        'title'     => [
            'title' => 'TAG: ' . $tagName,
            'more'  => [
            ],
        ],
        'condition' => ['article.id' => $tagArticleIDList],
        'pager'     => [
            'offset'          => 0,
            'defaultPageSize' => 10,
            'totalCount'      => $tagTotalCount,
        ],
    ])
    ?>
</div>
<?= $this->render("sider") ?>
