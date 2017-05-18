<?php
namespace widgets\Header;


use common\base\Widget;
use common\extend\Html;

class Header extends Widget
{
    /**
     * [
     * 'title' => 'Logo',
     * 'image' => '', //logo image
     * 'url'   => '', //logo image
     * ]
     *
     * @var array
     */
    public $logo = [];

    // 会把逗号分割了
    public $brand = "";

    public $subNav                 = [];
    public $subNavOptions          = [];
    public $subNavContainerOptions = ['class' => 'menu nav-sub text-right'];

    public $mainNav                 = [];
    public $mainNavOptions          = ['class' => 'menu nav-menu'];
    public $mainNavContainerOptions = ['class' => 'nav-main text-right'];

    public $options          = ['class' => 'nav'];
    public $containerOptions = ['class' => 'container'];

    public function run() {
        $subNav  = $this->renderMenuList($this->subNav, $this->subNavOptions);
        $mainNav = $this->renderMenuList($this->mainNav, $this->mainNavOptions);

        return $this->render("view", [
            'subNav'                  => $subNav,
            'mainNav'                 => $mainNav,
            'logo'                    => $this->logo,
            'brand'                   => array_filter(explode(",", $this->brand)),
            'mainNavContainerOptions' => $this->mainNavContainerOptions,
            'subNavContainerOptions'  => $this->subNavContainerOptions,
            'options'                 => $this->options,
            'containerOptions'        => $this->containerOptions,
        ]);
    }

    private function renderMenuList($menuList, $options = []) {
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