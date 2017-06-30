<?php
namespace application\widgets;


use common\base\Widget;
use common\extend\Html;

class Box extends Widget
{
    public $boxOptions = [];

    public $titleOptions = [];

    public $titleMain        = "";
    public $titleMainOptions = [];

    public $titleMore        = "";
    public $titleMoreOptions = [];

    public $bodyContent = "";
    public $bodyOptions = [];

    public $footerContent = "";
    public $footerOptions = "";

    public function init()
    {
        Html::prependCssClass($this->boxOptions, "box");
    }

    public function run()
    {
        $title  = $this->getTitle();
        $body   = $this->getBody();
        $footer = $this->getFooter();

        return Html::tag("div", $title . "\n" . $body . "\n" . $footer, $this->boxOptions);
    }

    public function getTitle()
    {
        Html::prependCssClass($this->titleMainOptions, "box-title-main");
        Html::prependCssClass($this->titleMoreOptions, "box-title-more");
        Html::prependCssClass($this->titleOptions, "box-title");

        $titleMain = Html::tag("div", $this->titleMain, $this->titleMainOptions);
        $titleMore = Html::tag("div", $this->titleMore, $this->titleMoreOptions);

        return Html::tag("div", $titleMain . "\n" . $titleMore, $this->titleOptions);
    }

    public function getBody()
    {
        Html::prependCssClass($this->bodyOptions, "bod-body");

        if (is_array($this->bodyContent)) {
            $content = Html::ul($this->bodyContent, $this->bodyOptions);

            return $content;
        }

        if (empty($this->bodyContent)) {
            $content = $this->bodyContent;

            return $content;
        }

        $content = Html::tag("div", $this->bodyContent, $this->bodyOptions);

        return $content;
    }

    public function getFooter()
    {
        Html::prependCssClass($this->footerOptions, "box-footer");

        if (is_array($this->footerContent)) {
            $content = Html::ul($this->footerContent, $this->footerOptions);

            return $content;
        }

        if (empty($this->footerContent)) {
            $content = $this->footerContent;

            return $content;
        }

        $content = Html::tag("div", $this->footerContent, $this->footerOptions);

        return $content;
    }
}