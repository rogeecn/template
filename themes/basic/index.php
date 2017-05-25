<?php

/** @var $this \common\extend\View */
?>


<?= \widgets\Carousel\Carousel::widget(['articleType' => 'carousel']) ?>

<?= \widgets\Announcement\Announcement::widget([]) ?>

<?= \widgets\ArticleList\ArticleList::widget([
    'title' => [
        'title' => '最新发布',
        'more'  => [
            'label' => 'themebetter 国内更好的WordPress主题服务商',
            'url'   => ["/"],
        ],
    ],
    'pager' => [
        'totalCount' => 1000,
    ],
    'items' => [
        [
            'title'   => '判断单、多张图片加载完成',
            'url'     => ["/site/read"],
            'meta'    => [
                'time'         => "2017-02-02",
                'author'       => "小仙",
                'viewCount'    => 123,
                'commentCount' => 233,
            ],
            'content' => '在实际的运用中有这样一种场景，某资源加载完成后再执行某个操作，例如在做导出时，后端通过打开模板页生成PDF，并返回下载地址。这时前后端通常需要约定一个flag，用以标识模板准备就绪，可以生成PDF了。试想，如果模板中有图片，此时如何判断图...',
            'image'   => [
                'http://demo.themebetter.com/dux/wp-content/uploads/sites/3/2015/06/1.jpg',
            ],
        ],

        [
            'title'   => '判断单、多张图片加载完成',
            'url'     => ["/site/read"],
            'meta'    => [
                'time'         => "2017-02-02",
                'author'       => "小仙",
                'viewCount'    => 123,
                'commentCount' => 233,
            ],
            'content' => '在实际的运用中有这样一种场景，某资源加载完成后再执行某个操作，例如在做导出时，后端通过打开模板页生成PDF，并返回下载地址。这时前后端通常需要约定一个flag，用以标识模板准备就绪，可以生成PDF了。试想，如果模板中有图片，此时如何判断图...',
            'image'   => [
                'http://demo.themebetter.com/dux/wp-content/uploads/sites/3/2015/06/1.jpg',
            ],
        ],
        [
            'title'   => '判断单、多张图片加载完成',
            'url'     => ["/site/read"],
            'meta'    => [
                'time'         => "2017-02-02",
                'author'       => "小仙",
                'viewCount'    => 123,
                'commentCount' => 233,
            ],
            'content' => '在实际的运用中有这样一种场景，某资源加载完成后再执行某个操作，例如在做导出时，后端通过打开模板页生成PDF，并返回下载地址。这时前后端通常需要约定一个flag，用以标识模板准备就绪，可以生成PDF了。试想，如果模板中有图片，此时如何判断图...',
            'image'   => [
                'http://demo.themebetter.com/dux/wp-content/uploads/sites/3/2015/06/1.jpg',
            ],
        ],
        [
            'title'   => '判断单、多张图片加载完成',
            'url'     => ["/site/read"],
            'meta'    => [
                'time'         => "2017-02-02",
                'author'       => "小仙",
                'viewCount'    => 123,
                'commentCount' => 233,
            ],
            'content' => '在实际的运用中有这样一种场景，某资源加载完成后再执行某个操作，例如在做导出时，后端通过打开模板页生成PDF，并返回下载地址。这时前后端通常需要约定一个flag，用以标识模板准备就绪，可以生成PDF了。试想，如果模板中有图片，此时如何判断图...',
            'image'   => [
                'http://demo.themebetter.com/dux/wp-content/uploads/sites/3/2015/06/1.jpg',
            ],
        ],
        [
            'title'   => '判断单、多张图片加载完成',
            'url'     => ["/site/read"],
            'meta'    => [
                'time'         => "2017-02-02",
                'author'       => "小仙",
                'viewCount'    => 123,
                'commentCount' => 233,
            ],
            'content' => '在实际的运用中有这样一种场景，某资源加载完成后再执行某个操作，例如在做导出时，后端通过打开模板页生成PDF，并返回下载地址。这时前后端通常需要约定一个flag，用以标识模板准备就绪，可以生成PDF了。试想，如果模板中有图片，此时如何判断图...',
            'image'   => [
                'http://demo.themebetter.com/dux/wp-content/uploads/sites/3/2015/06/1.jpg',
            ],
        ],
    ],
])
?>
