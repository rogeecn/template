<?php
namespace fields\Carousel;


use common\base\Field;
use common\base\IField;
use plugins\LayUI\components\Html;

class CarouselField extends Field implements IField
{
    public $name        = "carousel";
    public $description = "轮播图";
    public $table       = "field_carousel";

    public function init()
    {
        parent::init();
        $this->label = json_decode($this->label, true);
    }

    protected function renderField()
    {
        // 如果存在ID说明是可以查询数据的
        $this->value = ['link' => '', 'description' => ''];
        if (!empty($this->dataID)) {
            $this->value = $this->getData();
        }


        $content = "";


        $content .= Html::beginTag("div", ['class' => "layui-form-item layui-form-text"]);
        $content .= Html::label($this->label['link'], "", ['class' => 'layui-form-label']);
        $input = Html::textInput(sprintf("%s[link]", $this->name), $this->value['link']);
        $content .= Html::tag("div", $input, ['class' => "layui-input-block"]);
        $content .= Html::endTag("div");

        $content .= Html::beginTag("div", ['class' => "layui-form-item layui-form-text"]);
        $content .= Html::label($this->label['description'], "", ['class' => 'layui-form-label']);
        $input = Html::textarea(sprintf("%s[description]", $this->name), $this->value['description']);
        $content .= Html::tag("div", $input, ['class' => "layui-input-block"]);
        $content .= Html::endTag("div");

        return $content;
    }
}