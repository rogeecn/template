<?php
namespace widgets\Tab;


use common\base\Widget;
use plugins\LayUI\components\Html;
use yii\web\JqueryAsset;

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
        Html::addCssClass($this->options, ['widget', 'border', 'tab-show']);

        return $this->render("view", [
            'options' => $this->options,
            'items'   => $this->items,
        ]);
    }
}