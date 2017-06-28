<?php
namespace themes\basic\widgets\TagCloud;


use common\base\Widget;

class TagCloud extends Widget
{
    public $hasBorder = true;
    public $title     = '标签云';
    public $items     = [];

    public function run()
    {
        return $this->render("view", [
            'title'     => $this->title,
            'items'     => $this->items,
            'hasBorder' => $this->hasBorder,
        ]);
    }
}