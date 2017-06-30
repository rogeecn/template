<?php
namespace application\widgets;


use common\base\Widget;
use plugins\LayUI\components\Html;
use yii\web\JqueryAsset;

class Tab extends Widget
{
    public $items       = [];
    public $navOptions  = ['class' => 'tab-nav'];
    public $bodyOptions = ['class' => 'tab-body'];
    public $options     = [];

    public function init()
    {
        foreach ($this->items as &$item) {
            if ($item['content'] instanceof \Closure) {
                $item['content'] = $item['content']();
            }
        }

        $js = <<<_JS
$("body").on("mouseover",".tab-show .tab-nav li",function(e){
    if ($(this).hasClass("active")){return;}
    
    var index = $(this).index()
    
    var tabNav = $(this).closest(".tab-nav");
    var tabBody = $(this).closest(".tab-show").find(".tab-body");
    
    tabNav.find("li").removeClass("active");
    tabBody.find("li").removeClass("active");
    
    $(tabNav).find("li").eq(index).addClass("active");
    $(tabBody).find("li").eq(index).addClass("active");
})
_JS;

        JqueryAsset::register($this->getView());
        $this->getView()->registerJs($js);
    }

    public function run()
    {
        Html::addCssClass($this->options, ['tab']);

        $nav  = $this->getNav();
        $body = $this->getBody();

        return Html::tag("div", $nav . "\n" . $body, $this->options);
    }

    public function getNav()
    {
        $navList = [];
        foreach ($this->items as $index => $item) {
            if (!isset($item['options'])) {
                $item['options'] = [];
            }

            if ($index == 0) {
                Html::addCssClass($item['labelOptions'], "active");
            }

            $navContent = Html::tag("div", $item['label'], ['class' => 'title']);;
            $navList[] = Html::tag("li", $navContent, $item['labelOptions']);
        }

        return Html::tag("ul", implode("\n", $navList), $this->navOptions);
    }

    public function getBody()
    {
        $bodyList = [];
        foreach ($this->items as $index => $item) {
            if ($item instanceof \Closure) {
                echo $item();
                continue;
            }

            if (!isset($item['contentOptions'])) {
                $item['contentOptions'] = [];
            }

            if ($index == 0) {
                Html::addCssClass($item['contentOptions'], "active");
            }

            $bodyList[] = Html::tag("li", $item['content'], $item['contentOptions']);
        }

        return Html::tag("ul", implode("\n", $bodyList), $this->bodyOptions);
    }
}