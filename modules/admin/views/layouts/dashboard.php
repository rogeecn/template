<?php

/* @var $this \common\extend\View */
/* @var $content string */

$this->setAdminMode();
\modules\admin\assets\AppAssets::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后台</title>
    <?php $this->head() ?>
    <style>
        .layui-body .layui-tab-item {
            height: 99.5%;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header" style="text-align: right;">
        <a href="/admin" id="logo">やめて</a>
        <?= \common\extend\Html::ul([
            \common\extend\Html::a("访问首页", $this->setting("site.url"), ['target' => "_blank"]),
            \common\extend\Html::a("清理缓存", '/admin/clear-cache'),
            \common\extend\Html::a("退出", '/admin/logout'),
        ], [
            'class'       => 'layui-nav',
            'encode'      => false,
            'itemOptions' => [
                'class' => 'layui-nav-item',
            ],
        ]) ?>
    </div>
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <?= $this->render("_sidenav"); ?>
        </div>
    </div>
    <div class="layui-body" style="bottom: 0px;">
        <div class="layui-tab layui-tab-brief main-tab-container" lay-filter="tab-container" lay-allowclose="true"
             style="margin: 0">
            <ul class="layui-tab-title site-demo-title"></ul>
            <div class="layui-body layui-tab-content" style="padding:0px;left: 0px;top:40px;bottom: 0px"></div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
<script>
    var element = layui.element();
    $(function () {
        $("body").on("click", ".link-to-tab a", function (e) {
            console.log("click", $(this))
            e.preventDefault();
            e.stopPropagation();

            var link = $(this).attr("href");
            if (link.length == 0 || link == "#") {
                return false;
            }

            if ($(".main-tab-container .layui-tab-title li[lay-id='" + link + "']").length > 0) {
                element.tabChange('tab-container', link);

                $(".layui-body .layui-show").find("iframe").attr("src", link);
                return false;
            }

            var _iframeTpl = '<iframe src="_HREF_" frameborder="0" width="100%" height="100%"></iframe>';
            element.tabAdd('tab-container', {
                title: $(this).text(),
                content: _iframeTpl.replace("_HREF_", link),
                id: link,
            });
            element.tabChange('tab-container', link);
            return false;
        });


        // open first menu
        $(".link-to-tab a").eq(0).click();
    })
</script>
</body>
</html>
<?php $this->endPage() ?>
