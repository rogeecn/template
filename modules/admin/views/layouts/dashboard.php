<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use modules\admin\assets\EasyUIAssets;

EasyUIAssets::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <?php $this->head() ?>
    <style>
        a {
            text-decoration: none;
            color: #000000;
        }
    </style>
</head>
<body class="easyui-layout">
<?php $this->beginBody() ?>
<div data-options="region:'north',border:false" style="height:50px;">
    <?= Html::a("logout", ['/admin/logout']) ?>
</div>
<div data-options="region:'west',split:true,title:'West'" style="width:200px;">
    <ul id="menu-tree"></ul>
</div>
<div data-options="region:'south',border:false" style="height:5px"></div>
<div data-options="region:'center',border:false">
    <div id="main" class="easyui-panel" title="Dashboard" data-options="fit:true" style="overflow: hidden">
        <iframe id="content" name="content" src="/admin/dashboard" frameborder="0" width="100%" height="100%"></iframe>
    </div>
</div>
<?= $content ?>
<?php $this->endBody() ?>

<script>
    function setCenterData(title, url) {
        $("#main").panel("setTitle", title);
        if (url) {
            $("#content").attr("src", url)
        }
    }

    $(function () {
        //class="easyui-tree" data-options="lines:true,method:'get',url:'/dashboard/tree'"
        $('#menu-tree').tree({
            url: "/admin/tree?v="+Math.random(),
            lines: true,
            onClick: function (node) {
                if (node.attributes && node.attributes.url) {
                    setCenterData(node.text, node.attributes.url)
                }
            }
        });
    })
</script>
</body>
</html>
<?php $this->endPage() ?>
