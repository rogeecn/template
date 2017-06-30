<?php
namespace application\widgets;

use plugins\Carousel\CarouselAssets;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

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

        $config = Json::htmlEncode($this->config);
        $js     = <<<_JS_
$('#{$this->options['id']}').slick($config);
_JS_;
        $this->getView()->registerJs($js);
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
}