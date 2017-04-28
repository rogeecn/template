<?php

/* @var $this \yii\web\View */
/* @var $content string */

use application\assets\EasyUIAssets;

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
        a{
            text-decoration: none;
            color: #000000;
        }
    </style>
</head>
<body class="easyui-layout">
<?php $this->beginBody() ?>
<div data-options="region:'north',border:false" style="height:60px"></div>
<div data-options="region:'west',split:true,title:'West'" style="width:200px;padding:10px;">
    <ul id="menu-tree"></ul>
</div>
<div data-options="region:'south',border:false" style="height:5px"></div>
<div id="main" data-options="region:'center'" style="overflow: hidden" title="操作台">
    <iframe id="content" name="content" src="" frameborder="0" width="100%" height="100%"></iframe>
</div>
<?=$content?>
<?php $this->endBody() ?>

<script>
    function setCenterData(title, url){
        $("#main").attr("title",title)
        if (url){
            $("#content").attr("src",url)
        }
    }

    $(function(){
        //class="easyui-tree" data-options="lines:true,method:'get',url:'/dashboard/tree'"
        $('#menu-tree').tree({
            url:"/dashboard/tree",
            lines:true,
            onClick: function(node){
                if (node.attributes.url){
                    setCenterData(node.text,node.attributes.url)
                }
            }
        });
    })
</script>
</body>
</html>
<?php $this->endPage() ?>
