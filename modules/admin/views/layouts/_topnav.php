<a href="/admin" id="logo">やめて</a>
<?= \common\extend\Html::ul([
    \common\extend\Html::a("访问首页", $this->setting("site.url"), ['target' => "_blank"]),
    \common\extend\Html::a("清理缓存", '/admin/clear-cache'),
    \common\extend\Html::a("退出", '/admin/logout'),
], [
    'class'       => 'layui-nav',
    'encode'      => FALSE,
    'itemOptions' => [
        'class' => 'layui-nav-item',
    ],
]) ?>
