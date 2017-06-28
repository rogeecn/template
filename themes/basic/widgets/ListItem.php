<?php
namespace themes\basic\widgets;


use common\base\Widget;
use yii\helpers\Html;

class ListItem extends Widget
{
    public $items   = [];
    public $options = [];

    public function init()
    {
        Html::addCssClass($this->options, "list");
        if ($this->items instanceof \Closure) {
            $this->items = ($this->items)();
        }
    }

    public function run()
    {
        $itemList = [];
        foreach ($this->items as $index => $item) {
            if (!isset($item['options'])) {
                $item['options'] = [];
            }

            $tmpHtml = "";
            if (isset($item['time'])) {
                $tmpHtml .= Html::tag("time", $item['time']);
            }

            if (!isset($item['options']['title'])) {
                $item['options']['title'] = $item['title'];
            }

            if ($index == 0 || (isset($item['strong']) && $item['strong'])) {
                $item['title'] = Html::tag("strong", $item['title']);
            }

            if (isset($item['url'])) {
                $tmpHtml .= Html::a($item['title'], $item['url'], $item['options']);
            } else {
                $tmpHtml .= Html::tag("span", $item['title'], $item['options']);
            }

            $itemList[] = $tmpHtml;
        }
        $this->options['encode'] = false;

        return Html::ul($itemList, $this->options);
//        return Html::tag("ul", implode("\n", $itemList), $this->options);
    }
}