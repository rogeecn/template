<?php
namespace widgets\TagCloud;


use common\base\Widget;

class TagCloud extends Widget
{
    public $hasBorder = true;
    public $title     = '标签云';
    public $items     = [];
    public $baseURL   = "/tag";
    public $tagParam  = "tag";

    public function run() {
        return $this->render("view", [
            'title'     => $this->title,
            'items'     => $this->items,
            'tagParam'  => $this->tagParam,
            'baseURL'   => $this->baseURL,
            'hasBorder' => $this->hasBorder,
        ]);
    }
}