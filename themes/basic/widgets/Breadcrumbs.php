<?php
namespace themes\basic\widgets;


use common\base\Widget;
use common\extend\Html;
use common\models\Category;

class Breadcrumbs extends Widget
{
    public $categoryID = 0;
    public $text       = "";
    public $splitChar  = '&raquo;';
    public $options    = ['class' => 'breadcrumbs'];

    public function run()
    {
        $breadList = Category::breadCrumb($this->categoryID);

        $linkList = [];
        foreach ($breadList as $breadItem) {
            $url        = $this->view->categoryURL($breadItem['alias']);
            $linkList[] = Html::a($breadItem['name'], $url);
        }

        $index = Html::a(Html::icon("home", "&nbsp") . "首页", ['/']);
        array_unshift($linkList, $index);

        if (!empty($this->text)) {
            $text = Html::tag("span", $this->text);
            array_push($linkList, $text);
        }

        $splitHtml = Html::tag("span", $this->splitChar, ['class' => 'split']);

        return Html::div(implode($splitHtml, $linkList), $this->options);
    }
}