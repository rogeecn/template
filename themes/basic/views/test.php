<?php

?>
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

<ul class="nav-pills nav">
    <li><a href="/site/index">Home</a></li>
    <li class="dropdown">
        <a class="dropdown-toggle" href="#" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="nav-pills nav">
            <li><a href="#">Level 1 - Dropdown A</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Dropdown Header</li>
            <li><a href="#">Level 1 - Dropdown B</a></li>
        </ul>
    </li>
    <li><a href="/site/login">Login</a></li>
</ul>
