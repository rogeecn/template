<?php
/** @var $this \common\extend\View */
?>
<?= \widgets\Carousel\Carousel::widget([
    'items' => [
        [
            'label' => 'image_1',
            'image' => 'http://www.daqianduan.com/wp-content/uploads/2014/11/hs-xiu.jpg',
            'url'   => 'http://baidu.com',
        ],
        [
            'label' => 'image_1',
            'image' => 'http://www.daqianduan.com/wp-content/uploads/2014/11/hs-xiu.jpg',
            'url'   => 'http://baidu.com',
        ],
        [
            'label' => 'image_1',
            'image' => 'http://www.daqianduan.com/wp-content/uploads/2014/11/hs-xiu.jpg',
            'url'   => 'http://baidu.com',
        ],
    ],
]) ?>

<?= \widgets\Announcement\Announcement::widget([
    'title'    => [
        'label' => '滴滴出行(杭州)招聘资深前端开发工程师' . $this->setting("site.name"),
        'url'   => ["/read"],
    ],
    'category' => [
        'label' => '你好中国',
        'url'   => ["/category"],
    ],
    'content'  => '滴滴出行杭州团队，支持代驾及专车业务。 岗位职责： 独立负责承担一个子业务的前端设计与开发工作 建设与维护团队前端工程化及服务化体系 任职要求： 精通各种前端技术，对技术底层、原生JS、浏览器机制有深刻理解 有基于Node的全栈开发经验，对...',
]) ?>

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
