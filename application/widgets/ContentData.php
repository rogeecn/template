<?php
namespace application\widgets;


use common\base\Widget;

class ContentData extends Widget
{
    public $template = "<ul class='content-summary'><li>{items}</li>{pagination}</ul>";
    public $dataProvider;

    public function run()
    {

    }
}