<?php
namespace widgets\BlockShow;


use common\base\Widget;
use plugins\LayUI\components\Html;

class BlockShow extends Widget
{
    public $tag        = 'a';
    public $tagOptions = [];
    public $style      = 'style01';
    public $band       = '吐血推荐';
    public $title      = "";
    public $content    = "";

    public function run() {
        Html::addCssClass($this->tagOptions, ['widget', 'block-show', $this->style]);

        return $this->render("view", [
            'tag'        => $this->tag,
            'tagOptions' => $this->tagOptions,
            'band'       => $this->band,
            'title'      => $this->title,
            'content'    => $this->content,
        ]);
    }
}