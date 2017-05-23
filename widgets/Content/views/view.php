<?php
use yii\helpers\Html;

?>
<div class="article">
    <header><h1><?= $title ?></h1></header>

    <div class="meta">
        <span><i class="fa fa-clock-o">&nbsp;</i><?= $meta['time'] ?></span>
        <span><i class="fa fa-comments-o">&nbsp;</i>评论(<?= $meta['commentCount'] ?>)</span>
        <span>
            <i class="fa fa-id-card-o">&nbsp;</i>
            分类：<?= Html::a($meta['category']['label'], $meta['category']['url']) ?>
        </span>
        <span><i class="fa fa-eye">&nbsp;</i>阅读(<?= $meta['viewCount'] ?>)</span>
    </div>

    <article class="content-data"><?= $content ?></article>
</div>

