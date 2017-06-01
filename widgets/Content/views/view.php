<?php
use yii\helpers\Html;

$editLink = \common\extend\Html::a('编辑', ['/admin/article/update', 'id' => $articleID], ['target' => '_blank']);
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
        <?php if (\common\extend\UserInfo::isAdmin()): ?>
            <span>
                <i class="fa fa-edit">&nbsp;</i>
                <?= $editLink ?>
            </span>
        <?php endif; ?>
    </div>

    <article class="content-data"><?= $content ?></article>
</div>

