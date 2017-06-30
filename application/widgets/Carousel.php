<?php
namespace application\widgets;

use plugins\Carousel\CarouselAssets;
use yii\base\Widget;
use yii\helpers\Html;

class Carousel extends Widget
{
    /**
     * $items[] = [
     *      'label' => 'able',
     *      'description' => 'description',
     *      'content' => 'html content',
     *      'url'   => 'http://baidu.com.cn',
     * ];
     *
     * @var array
     */
    public $items              = [];
    public $options            = ['class' => 'carousel slick-slider'];
    public $itemOptions        = [];
    public $descriptionOptions = ['class' => 'description'];
    /**
     * @var array
     * @document http://kenwheeler.github.io/slick/
     */
    public $config = [];

    public function init()
    {

        if (!isset($this->options['id'])) {
            $this->options['id'] = self::getId();
        }
        $this->getView()->registerJs($this->getJS());
        CarouselAssets::register($this->getView());
    }

    public function run()
    {
        if (empty($this->items)) {
            return Html::tag("div", "", $this->options);
        }

        $items = [];
        foreach ($this->items as $item) {
            $content = $item['content'];
            if (!empty($item['description'])) {
                $content .= "\n" . Html::tag("div", $item['description'], $this->descriptionOptions);
            }
            if (empty($item['url'])) {
                $content = Html::tag("div", $content, $this->itemOptions);
            } else {
                $content = Html::a($content, $item['url'], $this->itemOptions);
            }


            $items[] = $content;
        }

        return Html::tag("div", implode("\n", $items), $this->options);
    }

    private function getJS()
    {
        $config = json_encode($this->config);
        $js     = <<<_JS_
var slickConfig = JSON.parse("$config");
$('#{$this->options['id']}').slick(slickConfig);
_JS_;

        return $js;
    }
}