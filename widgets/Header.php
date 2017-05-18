<?php
namespace widgets;


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
    public $subNavContainerOptions = ['class' => 'nav-sub text-right'];

    public $mainNav                 = [];
    public $mainNavOptions          = ['class' => 'nav-menu'];
    public $mainNavContainerOptions = ['class' => 'nav-main text-right'];

    public $options          = ['class' => 'nav'];
    public $containerOptions = ['class' => 'container'];

    public function run()
    {

        $subNav  = $this->renderMenuList($this->subNav, $this->subNavOptions);
        $mainNav = $this->renderMenuList($this->mainNav, $this->mainNavOptions);
        $logo    = $this->renderLogo($this->logo);
        $brand   = $this->renderBrand($this->brand);

        $subNavContainerHtml  = Html::div($subNav, $this->subNavContainerOptions);
        $mainNavContainerHtml = Html::div($logo . $brand . $mainNav, $this->mainNavContainerOptions);

        return Html::div(Html::div($subNavContainerHtml . $mainNavContainerHtml, $this->containerOptions), $this->options);
    }

    private function renderLogo($logo)
    {
        $image = "";
        if (!empty($logo['image'])) {
            $image = Html::img($logo['image'], ['alt' => $logo['title']]);
        }
        $html = Html::a($logo['title'] . $image, $logo['url']);

        return Html::tag("h1", $html, ['class' => 'logo']);
    }

    private function renderBrand($brand)
    {
        $brand = explode(",", $brand);

        return Html::div(implode("<br>", $brand), ['class' => 'brand']);
    }

    private function renderMenuList($menuList, $options = [])
    {
        $menuItems = [];
        foreach ($menuList as $menu) {
            if (isset($menu['items'])) {
                $tmpHtml = Html::tag("span", $menu['label']);
                $tmpHtml .= $this->renderMenuList($menu['items']);
            } else {
                $tmpHtml = Html::a($menu['label'], $menu['url']);
            }

            $menuItems[] = Html::li($tmpHtml);
        }

        return Html::tag("ul", implode("\n", $menuItems), $options);
    }
}