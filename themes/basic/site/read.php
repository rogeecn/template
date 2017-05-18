<div class="page-article">
    <?= \widgets\Content\Content::widget([
        'title'       => '际的运用中有这样一种场景，某资源加载完成后再执行某个',
        'content'     => $this->render("_content_data"),
        'description' => "hello world!",
        'meta'        => [
            'time'         => '2017-01-01',
            'commentCount' => '12',
            'viewCount'    => '12343',
            'category'     => [
                'name' => '生活常识',
                'url'  => '/category/name',
            ],
        ],
    ]) ?>

    <div class="post-copyright">
        未经允许不得转载：<a href="http://www.daqianduan.com">大前端</a> » <a href="http://www.daqianduan.com/6419.html">判断单、多张图片加载完成</a>
    </div>

    <?= \widgets\PostAuthor::widget([
        'headImage' => 'https://secure.gravatar.com/avatar/fbe1c43581600c6a1e6c3de93321f7e8?s=100&d=mm',
        'nickname'  => 'GoMan',
        'signature' => '我就是我，颜色不一样的火',
    ]) ?>

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