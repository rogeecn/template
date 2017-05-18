<?php
namespace widgets;


use common\base\Widget;
use common\extend\Html;

class ColumnShow extends Widget
{
    public $title   = "";
    public $style   = "";
    public $link    = [];
    public $options = [];

    public function init()
    {
        Html::addCssClass($this->options, ['widget', 'full-column-show', $this->style]);
    }

    public function run()
    {
        $title = Html::tag("h2", $this->title);
        $link  = Html::a($this->link['label'], $this->link['url'], ['target' => "_blank"]);

        return Html::div(Html::div($title . $link, ['class' => 'container']), $this->options);
    }
}