<?php
use yii\helpers\Html;

?>
<article class="list-item has-image first">
    <a href="" class="head-image">
        <img src="http://demo.themebetter.com/dux/wp-content/uploads/sites/3/2015/06/1.jpg" alt="">
    </a>
    <div class="list-item-info">
        <header><h2><?=Html::a($title,$url)?>></h2></header>
        <p class="meta">
            <span class="time"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?=$meta['time']?></span>
            <span class="author"><i class="fa fa-user-o"></i>&nbsp;&nbsp;<?=$meta['author']?></span>
            <span class="pv"><i class="fa fa-eye"></i>&nbsp;&nbsp;浏览(<?=$meta['viewCount']?>)</span>
            <span class="comment"><i class="fa fa-comments-o"></i>&nbsp;&nbsp;评论(<?=$meta['commentCount']?>)</span>
        </p>
        <p class="note"><?=$content?></p>
    </div>
</article>
