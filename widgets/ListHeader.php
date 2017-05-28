<?php
namespace widgets;


use common\base\Widget;
use yii\helpers\Html;

class ListHeader extends Widget
{
    public $title = [];
    public $more  = [];

    public function run()
    {
        $title = Html::tag("h3", $this->title);

        $moreLinkHtml = "";
        if (!empty($this->more)) {
            $moreLinkHtml = Html::tag("div", Html::a($this->more['label'], $this->more['url']), ['class' => 'more']);
        }
        $allTitle = Html::tag("div", $title . $moreLinkHtml, ['class' => 'title']);

        return Html::tag("div", $allTitle, ['class' => 'common-header']);
    }
}