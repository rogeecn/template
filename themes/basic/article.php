<div class="content">
    <?= \widgets\Breadcrumbs::widget(['categoryID' => $categoryID]) ?>

    <div class="page-article">
        <?= \widgets\Content\Content::widget(['articleID' => $articleInfo['id']]); ?>
        <?= \widgets\ContentCopyright::widget(['articleID' => $articleInfo['id']]) ?>

        <?php /*= \widgets\PostAuthor::widget([
        'headImage' => 'https://secure.gravatar.com/avatar/fbe1c43581600c6a1e6c3de93321f7e8?s=100&d=mm',
        'nickname'  => 'GoMan',
        'signature' => '我就是我，颜色不一样的火',
    ]) */ ?>

        <?= \widgets\RecommendList::widget([
            'title' => '相关推荐',
            'items' => [
                [
                    'title' => 'UX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而',
                    'url'   => ["/"],
                    'time'  => '2017-02-02',
                ],
                [
                    'title' => 'UX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而',
                ],
                [
                    'title' => 'UX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而',
                    'url'   => ["/"],
                    'time'  => '2017-02-02',
                ],
                [
                    'strong' => TRUE,
                    'title'  => 'UX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而',
                    'time'   => '2017-02-02',
                ],
                [
                    'title' => 'UX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而',
                    'url'   => ["/"],
                    'time'  => '2017-02-02',
                ],
                [
                    'title' => 'UX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而',
                    'time'  => '2017-02-02',
                ],
            ],
        ]) ?>
    </div>
</div>
<?= $this->render("sider") ?>
