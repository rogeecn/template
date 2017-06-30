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

    protected function renderField()
    {
        // 如果存在ID说明是可以查询数据的
        $this->value = ['link' => '', 'description' => ''];
        if (!empty($this->dataID)) {
            $this->value = $this->getData();
        }


        $linkContent = "";
        $inputName   = sprintf("%s[link]", $this->name);
        $linkContent .= BSHtml::label($this->label['link']);
        $linkContent .= BSHtml::textInput($inputName, $this->value['link']);
        $linkContent = BSHtml::formItem($linkContent);

        $descriptionContent = "";
        $inputName          = sprintf("%s[description]", $this->name);
        $descriptionContent .= BSHtml::label($this->label['description']);
        $descriptionContent .= BSHtml::textarea($inputName, $this->value['description']);
        $descriptionContent = BSHtml::formItem($descriptionContent);

        return $linkContent . "\n" . $descriptionContent;
    }
}