<?php
namespace widgets;


use common\base\Widget;
use common\extend\Html;
use common\models\Category;

class Breadcrumbs extends Widget
{
    public $categoryID = 0;
    public $splitChar  = '&raquo;';
    public $param      = 'cat';
    public $route      = '/category';
    public $options    = ['class' => 'breadcrumbs'];

    public function init() {
    }

    public function run() {
        $breadList = Category::breadCrumb($this->categoryID);

        $linkList = [];
        foreach ($breadList as $breadItem) {
            $url        = [$this->route, $this->param => $breadItem['alias']];
            $linkList[] = Html::a($breadItem['name'], $url);
        }

        $splitHtml = Html::tag("span", $this->splitChar, ['class' => 'split']);
        return Html::div(implode($splitHtml, $linkList), $this->options);
    }
}