<?php
namespace common\extend;


class LinkPager extends \yii\widgets\LinkPager
{
    public $maxButtonCount = 5;
    public $nextPageLabel  = '下一页';
    public $prevPageLabel  = '上一页';
}
