<?php
namespace widgets\Tab;


use common\base\Widget;
use plugins\LayUI\components\Html;

class Tab extends Widget
{
    public $items   = [];
    public $options = [];

    public function init()
    {
        foreach ($this->items as &$item) {
            if ($item['content'] instanceof \Closure) {
                $item['content'] = $item['content']();
            }
        }
    }

    public function run()
    {
        Html::addCssClass($this->options, ['widget', 'tab-show']);

        return $this->render("view", [
            'options' => $this->options,
            'items'   => $this->items,
        ]);
    }
}