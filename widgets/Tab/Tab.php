<?php
namespace widgets\Tab;


use common\base\Widget;
use plugins\LayUI\components\Html;

class Tab extends Widget
{
    public $items   = [];
    public $options = [];

    public function run() {
        Html::addCssClass($this->options, ['widget', 'tab-show']);

        return $this->render("view", [
            'options' => $this->options,
            'items'   => $this->items,
        ]);
    }
}