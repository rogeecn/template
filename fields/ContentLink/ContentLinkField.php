<?php
namespace fields\ContentLink;


use common\base\Field;
use common\base\IField;
use plugins\LayUI\components\Html;

class ContentLinkField extends Field implements IField
{
    public $name        = "content_link";
    public $description = "内容链接";
    public $table       = "field_content_link";

    private $styleList = [
        'style01' => '蓝色',
        'style02' => '橙色',
    ];

    public function init()
    {
        parent::init();
        $this->label = json_decode($this->label, true);
    }

    protected function renderField()
    {
        // 如果存在ID说明是可以查询数据的
        $this->value = ['content' => '', 'link' => ''];
        if (!empty($this->dataID)) {
            $this->value = $this->getData();
        }


        $content = "";

        $content .= Html::beginTag("div", ['class' => "layui-form-item layui-form-text"]);
        $content .= Html::label($this->label['style'], "", ['class' => 'layui-form-label']);
        $input = Html::dropDownList(sprintf("%s[style]", $this->name), $this->value['style'], $this->styleList);
        $content .= Html::tag("div", $input, ['class' => "layui-input-block"]);
        $content .= Html::endTag("div");

        $content .= Html::beginTag("div", ['class' => "layui-form-item layui-form-text"]);
        $content .= Html::label($this->label['tag'], "", ['class' => 'layui-form-label']);
        $input = Html::textInput(sprintf("%s[tag]", $this->name), $this->value['tag']);
        $content .= Html::tag("div", $input, ['class' => "layui-input-block"]);
        $content .= Html::endTag("div");

        $content .= Html::beginTag("div", ['class' => "layui-form-item layui-form-text"]);
        $content .= Html::label($this->label['link'], "", ['class' => 'layui-form-label']);
        $input = Html::textInput(sprintf("%s[link]", $this->name), $this->value['link']);
        $content .= Html::tag("div", $input, ['class' => "layui-input-block"]);
        $content .= Html::endTag("div");

        $content .= Html::beginTag("div", ['class' => "layui-form-item layui-form-text"]);
        $content .= Html::label($this->label['content'], "", ['class' => 'layui-form-label']);
        $input = Html::textarea(sprintf("%s[content]", $this->name), $this->value['content']);
        $content .= Html::tag("div", $input, ['class' => "layui-input-block"]);
        $content .= Html::endTag("div");

        return $content;
    }
}