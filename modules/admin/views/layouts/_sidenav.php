<?php
use common\extend\Html;

?>
<ul class="layui-nav layui-nav-tree site-demo-nav link-to-tab">
    <li class="layui-nav-item">
        <a href="/admin/dashboard"><?= Html::icon("dashboard", "&nbsp;") ?>控制台</a>
    </li>

    <li class="layui-nav-item layui-nav-itemed">
        <a href="#"><?= Html::icon("file-text-o", "&nbsp;") ?>内容管理<span class="layui-nav-more"></span></a>
        <dl class="layui-nav-child">
            <dd><a href="/admin/article/type/list">添加内容</a></dd>
            <dd><a href="/admin/article/manage">内容列表</a></dd>
            <dd><a href="/admin/article/type/manage">内容类型</a></dd>
            <dd><a href="/admin/tag/list">标签管理</a></dd>
            <dd><a href="/admin/category/list">分类管理</a></dd>
        </dl>
    </li>
    <li class="layui-nav-item layui-nav-itemed">
        <a href="#"><?= Html::icon("cubes", "&nbsp;") ?>链接管理<span class="layui-nav-more"></span></a>
        <dl class="layui-nav-child">
            <dd><a href="/admin/link/group">链接管理</a></dd>
        </dl>
    </li>
    <li class="layui-nav-item layui-nav-itemed">
        <a href="#"><?= Html::icon("cogs", "&nbsp;") ?>设置<span class="layui-nav-more"></span></a>
        <dl class="layui-nav-child">
            <dd><a href="/admin/setting/manage">参数设置</a></dd>
            <dd><a href="/admin/setting/group">配置分组</a></dd>
            <dd><a href="/admin/backup/config">备份</a></dd>
        </dl>
    </li>
</ul>
