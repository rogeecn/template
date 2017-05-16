<?php
namespace plugins\Carousel;

use yii\base\Widget;
use yii\helpers\Html;

class Carousel extends Widget
{
    /**
     * @var array
     * [
     *      'label'=>'',
     *      'image'=>'',
     *      'url'=>'',
     * ]
     */
    public $items = [];
    public $options = [];
    public function init()
    {
        CarouselAssets::register($this->getView());

        if (!isset($this->options['id'])){
            $this->options['id'] = self::getId();
        }

        Html::addCssClass($this->options,"carousel slick-slider");

        $this->getView()->registerJs($this->getJS());
    }

    public function run()
    {
        $links = [];
        foreach ($this->items as $item){
            $tmpLink = Html::a(Html::img($item['image']),$item['url'],['title'=>$item['label']]);
            $links[]= $tmpLink;
        }

        return Html::tag("div",implode("\n",$links),$this->options);
    }

    private function getJS()
    {
        $js = <<<_JS_
      $('#{$this->options['id']}').slick({dots: true});
_JS_;

        return $js;
    }
}