<aside class="sidebar">

    <?= \themes\basic\widgets\TagCloud\TagCloud::widget([
        'items' => \common\models\Tag::getList(18, TRUE),
    ]) ?>
</aside>
