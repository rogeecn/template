<?php
namespace widgets;


use common\base\Widget;
use common\extend\Html;

class NavItem extends Widget
{
    public $options          = [];
    public $containerOptions = [];
    public $items            = [];

    public function run()
    {
        $nav = $this->renderMenuList($this->items, $this->options);

        return Html::div($nav, $this->containerOptions);
    }

    private function renderMenuList($menuList, $options = [])
    {
        $menuItems = [];
        foreach ($menuList as $menu) {
            if (isset($menu['items'])) {
                $downArrow = Html::icon("sort-down", "", ['style' => 'position: absolute;margin-left: 3px;']);
                $tmpHtml   = Html::a($menu['label'] . $downArrow, "javascript:void(0);");
                $tmpHtml .= $this->renderMenuList($menu['items'], ['class' => 'sub-menu']);
            } else {
                $tmpHtml = Html::a($menu['label'], $menu['url']);
            }

            $menuItems[] = Html::li($tmpHtml);
        }

        return Html::tag("ul", implode("\n", $menuItems), $options);
    }
}