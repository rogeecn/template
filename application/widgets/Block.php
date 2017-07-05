<?php
namespace application\widgets;


use common\base\Widget;
use common\extend\Html;

class Block extends Widget
{
    public  $type    = "text"; // text,html
    public  $name    = "";
    public  $data    = "";
    public  $tag     = "div";
    public  $options = [];
    private $encode  = FALSE;

    public function init()
    {
        if ($this->type == "text") {
            $this->encode = TRUE;
        }
    }

    public function run()
    {
        if ($this->encode) {
            $this->data = Html::encode($this->data);
        }

        return Html::tag($this->tag, $this->data, $this->options);
    }
}