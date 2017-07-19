<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

NavBar::begin([
    'innerContainerOptions' => ['class' => 'container-fluid'],
    'brandLabel'            => FALSE,
    'options'               => [
        'class' => 'navbar-inverse navbar-fixed-top',
        'style' => 'z-index: 601',
    ],
]);


$menuItems = [
    ['label' => '控制台', 'url' => ['/admin']],
    [
        'label' => '内容',
        'items' => [
            ['label' => '添加内容', 'url' => ['/admin/article/type/list']],
            ['label' => '内容列表', 'url' => ['/admin/article/manage']],
            ['label' => '内容类型', 'url' => ['/admin/article/type/manage']],
            ['label' => '标签管理', 'url' => ['/admin/tag/list']],
            ['label' => '分类管理', 'url' => ['/admin/category/list']],
        ],
    ],
    [
        'label' => '用户',
        'items' => [
            ['label' => '用户添加', 'url' => ['/admin/member/create']],
            ['label' => '用户列表', 'url' => ['/admin/member/list']],
        ],
    ],
];

$right_items = [
    ['label' => '访问首页', 'url' => $this->setting("site.url"), 'linkOptions' => ['target' => "_blank"]],
    [
        'label' => '设置',
        'items' => [
            ['label' => '链接管理', 'url' => ['/admin/link/group']],
            ['label' => '参数设置', 'url' => ['/admin/setting/manage']],
            ['label' => '配置分组', 'url' => ['/admin/setting/group']],
            ['label' => '备份', 'url' => ['/admin/backup/config']],
            ['label' => '清除缓存', 'url' => ['/admin/clear-cache']],
        ],
    ],
    ['label' => '退出', 'url' => ['/admin/logout']],
];

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items'   => $menuItems,
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items'   => $right_items,
]);

NavBar::end();
