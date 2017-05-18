<?php
use yii\helpers\Html;

?>
<?= Html::beginTag("article", $options) ?>
<?= Html::a(Html::img($image[0]), $url, ['class' => 'head-image']) ?>
<div class="list-item-info">
    <header><h2><?= Html::a($title, $url) ?></h2></header>
    <p class="meta">
        <span class="time"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?= $meta['time'] ?></span>
        <span class="author"><i class="fa fa-user-o"></i>&nbsp;&nbsp;<?= $meta['author'] ?></span>
        <span class="pv"><i class="fa fa-eye"></i>&nbsp;&nbsp;浏览(<?= $meta['viewCount'] ?>)</span>
        <span class="comment"><i class="fa fa-comments-o"></i>&nbsp;&nbsp;评论(<?= $meta['commentCount'] ?>)</span>
    </p>
    <p class="note"><?= $content ?></p>
</div>
<?= Html::endTag("article") ?>
