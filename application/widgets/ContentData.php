<?php
namespace application\widgets;


use common\base\Widget;

class ContentData extends Widget
{
    public $template = "<div class='content-data'><h1>{title}</h1><div class='description'>{description}</div><div class='content-detail'>{content}</div></div>";
    public $dataProvider;

    public function init()
    {
        $data = [];
        foreach ($this->dataProvider as $key => $value) {
            $key        = sprintf("{%s}", $key);
            $data[$key] = $value;
        }
        $this->dataProvider = $data;
    }

    public function run()
    {

        return strtr($this->template, $this->dataProvider);
    }
}