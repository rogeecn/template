<?= \themes\basic\widgets\Breadcrumbs::widget(['categoryID' => $categoryID]) ?>
<div class="content">
    <div class="page-article">
        <?= \themes\basic\widgets\Content\Content::widget([
            'articleID' => $articleInfo['id'],
        ]); ?>
    </div>

    <div class="article-comment">
        <?= \plugins\ChangYan\ChangYan::widget([
            'sourceID' => $articleInfo['id'],
            'appID'    => 'cyrbSNz14',
            'configID' => 'prod_8181dfa586ca48f35117b8cfc724e927',
        ]) ?>
    </div>
</div>

<!--side-->
<aside class="sidebar">
    <?= \themes\basic\widgets\TagCloud\TagCloud::widget([
        'items' => \common\models\Tag::getList(18, TRUE),
    ]) ?>

    <?= \themes\basic\widgets\CategoryBox::widget([
        'title'      => '分类文章',
        'categoryID' => $articleInfo['category_id'],
    ]);
    ?>

    <?= \themes\basic\widgets\LatestArticles::widget() ?>
</aside>

