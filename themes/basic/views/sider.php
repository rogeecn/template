<aside class="sidebar">

    <?= \themes\basic\widgets\TagCloud\TagCloud::widget([
        'items' => \common\models\Tag::getList(18, TRUE),
    ]) ?>

    <?= \themes\basic\widgets\LatestArticles::widget() ?>
</aside>
