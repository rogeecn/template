<?php
namespace widgets\Carousel;

use common\models\Article;
use plugins\Carousel\CarouselAssets;
use yii\base\Widget;
use yii\helpers\Html;

class Carousel extends Widget
{
    public $articleType   = 'carousel';
    public $items         = [];
    public $options       = [];
    public $autoPlay      = true;
    public $autoPlaySpeed = 2000;

    public function init()
    {
        $this->autoPlay = $this->autoPlay ? "true" : "false";
        CarouselAssets::register($this->getView());

        if (!isset($this->options['id'])) {
            $this->options['id'] = self::getId();
        }

        Html::addCssClass($this->options, "carousel slick-slider");

        $this->getView()->registerJs($this->getJS());

        // article data
        $dataList = Article::getListByTypeAlias($this->articleType, 0, 3);

        $items = [];
        foreach ($dataList as $item) {
            $items[] = [
                'label' => $item['title'],
                'image' => $item['fields']['image']['image'],
                'url'   => $item['fields']['carousel']['link'],
            ];
        }

        $this->items = $items;
    }

    public function run()
    {
        $links = [];
        foreach ($this->items as $item) {
            $tmpLink = Html::a(Html::img($item['image']), $item['url'], ['title' => $item['label']]);
            $links[] = $tmpLink;
        }

        return Html::tag("div", implode("\n", $links), $this->options);
    }

    private function getJS()
    {
        $js = <<<_JS_
$('#{$this->options['id']}').slick({
    dots: true,
    autoplay: {$this->autoPlay},
    autoplaySpeed: {$this->autoPlaySpeed},
});
_JS_;

        return $js;
    }
}