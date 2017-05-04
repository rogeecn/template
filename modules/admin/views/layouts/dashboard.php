<?php

/* @var $this \yii\web\View */
/* @var $content string */

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
        .layui-body .layui-tab-item{
            height:100%;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header" style="text-align: right;">
        <?=$this->render("_topnav");?>
    </div>
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <?=$this->render("_sidenav");?>
        </div>
    </div>
    <div class="layui-body">
        <div class="layui-tab layui-tab-brief" lay-filter="tab-container"  lay-allowclose="true" style="margin: 0">
            <ul class="layui-tab-title site-demo-title">
                <li class="layui-this">控制台</li>
            </ul>
            <div class="layui-body layui-tab-content" style="left: 0px;top:40px;bottom: 0px">
                <div class="layui-tab-item layui-show">
                    <p>Dashboard</p>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-footer">
        <!-- 底部固定区域 -->
    </div>
</div>
<?php $this->endBody() ?>
<script>
    var element = layui.element();
    $(function(){
        $("body").on("click",".link-to-tab a",function(e){
            console.log("click",$(this))
            e.preventDefault();
            e.stopPropagation();

            var link = $(this).attr("href");
            if (link.length == 0 || link == "#"){
                return false;
            }

            var _iframeTpl = '<iframe src="_HREF_" frameborder="0" width="100%" height="100%"></iframe>';
            element.tabAdd('tab-container', {
                title: $(this).text(),
                content: _iframeTpl.replace("_HREF_",link),
                id: link,
            });
            element.tabChange('tab-container', link);
            return false;
        })
    })
</script>
</body>
</html>
<?php $this->endPage() ?>
