<?php
namespace themes\basic\widgets;


use common\base\Widget;
use common\extend\Html;

class RecommendList extends Widget
{
    public $title = "";
    public $items = "";

    public function run()
    {
        $itemList = ListItem::widget(['items' => $this->items]);
        $title    = Html::tag("div", $this->title, ['class' => 'title']);

        return Html::tag("div", $title . $itemList, ['class' => 'post-recommend']);
    }
}