<?php
namespace widgets;


use common\base\Widget;
use plugins\LayUI\components\Html;

class PostAuthor extends Widget
{
    public $headImage = "";
    public $nickname  = "";
    public $signature = "";

    public function run()
    {
        $headImage = Html::tag("div", Html::img($this->headImage), ['class' => 'head']);

        $nickname   = Html::tag("span", Html::icon("user")."&nbsp;" . Html::tag("strong", $this->nickname), ['class' => 'name']);
        $signature  = Html::tag("p", $this->signature, ['class' => 'signature']);
        $authorInfo = Html::tag("div", $nickname . $signature, ['class' => 'author-info']);

        return Html::tag('div', $headImage . $authorInfo, ['class' => 'post-author']);
    }
}