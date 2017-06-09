<?php
namespace fields\Carousel;


use common\base\Field;
use common\base\IField;
use common\extend\BSHtml;

class CarouselField extends Field implements IField
{
    public $name        = "carousel";
    public $description = "轮播图";
    public $table       = "field_carousel";

    public function init()
    {
        parent::init();
        $this->label = json_decode($this->label, TRUE);
    }

    protected function renderField()
    {
        // 如果存在ID说明是可以查询数据的
        $this->value = ['link' => '', 'description' => ''];
        if (!empty($this->dataID)) {
            $this->value = $this->getData();
        }


        $content = "";

        $inputName = sprintf("%s[link]", $this->name);
        $content .= BSHtml::label($this->label['link']);
        $content .= BSHtml::textInput($inputName, $this->value['link']);
        $content .= BSHtml::formItem($content);

        $inputName = sprintf("%s[description]", $this->name);
        $content .= BSHtml::label($this->label['description']);
        $content .= BSHtml::textarea($inputName, $this->value['description']);
        $content .= BSHtml::formItem($content);

        return $content;
    }
}