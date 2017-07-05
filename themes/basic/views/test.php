<p>-----------------------------------------------</p>


<?= \application\widgets\ContentSummaryList::widget([
    'pagination' => [
        'totalCount' => 1000,
    ],
    'items'      => [
        \application\widgets\ContentSummaryItem::widget([
            'dataProvider' => \themes\basic\data\ContentSummary::widget(),
        ]),
        \application\widgets\ContentSummaryItem::widget([
            'dataProvider' => [
                'title'       => "Hello  world!",
                'description' => "description Hello  world!",
                'image'       => "http://officejineng.com/themes/basic/assets/images/logo.png",
                'author'      => "Rogee",
                'publish_at'  => date("Ymd"),
                'view_cnt'    => 100,
                'comment_cnt' => 10,
            ],
        ]),
    ],
]) ?>


<p>-----------------------------------------------</p>


<?php echo \application\widgets\Tab::widget([
    'items' => [
        [
            'label'          => 'hello',
            'labelOptions'   => [
                'class' => 'label',
            ],
            'content'        => 'Label Content',
            'contentOptions' => [
                'class' => 'contentOptions',
            ],
        ],

        [
            'label'          => 'hello2',
            'labelOptions'   => [
                'class' => 'label2',
            ],
            'content'        => 'Label Content2',
            'contentOptions' => [
                'class' => 'contentOptions2',
            ],
        ],
    ],
]) ?>


<p>-----------------------------------------------</p>


<?php echo \application\widgets\Nav::widget([
    'items'   => [
        [
            'label'       => 'Home',
            'url'         => ['site/index'],
            'linkOptions' => [],
        ],
        [
            'label' => 'Dropdown',
            'items' => [
                ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                '<li class="divider">Hello world!</li>',
                '<li class="dropdown-header">Dropdown Header</li>',
                ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
            ],
        ],
        [
            'label' => 'Login',
            'url'   => ['site/login'],
        ],
    ],
    'options' => ['class' => 'nav-pills'],
]);
?>


<p>-----------------------------------------------</p>

<?= \application\widgets\Carousel::widget([
    'items' => \themes\basic\util\CarouselDataProvider::widget(),
]) ?>

<?= \application\widgets\Breadcrumbs::widget([
    'categoryID' => 11,
    'linkList'   => [
        ['label' => 'itemAppend', 'url' => '#'],
        "pure text",
    ],
]); ?>

