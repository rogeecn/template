<?php
namespace fields\ueditor;


use common\base\Field;
use common\base\IField;
use plugins\LayUI\components\Html;
use modules\ueditor\widget\UEditorInput;

class UEditorField extends Field implements IField
{
    public $name        = "ueditor";
    public $description = "UEditor 富文本编辑器";
    public $table       = "field_content_data";

    protected function getOptions() {
        return [
            [
                'type'   => 'checkbox',
                'name'   => 'showDescription',
                'value'  => false,
                'config' => [
                    'title'    => '使用概要输入',
                    'lay-skin' => 'primary',
                ],
            ],
            [
                'type'   => 'checkbox',
                'name'   => 'showLabel',
                'value'  => false,
                'config' => [
                    'title'    => '显示标签',
                    'lay-skin' => 'primary',
                ],
            ],
        ];
    }


    protected function renderField() {
        $this->label = json_decode($this->label, true);

        // 如果存在ID说明是可以查询数据的
        if (!empty($this->dataID)){
            $this->value = $this->getData();
        }
        $content = "";
        if ($this->options['showDescription']) {
            $value = "";
            if (isset($this->value['description'])){
                $value = $this->value['description'];
            }
            $input = Html::textarea(sprintf("%s[description]", $this->name), $value);
            $label = Html::label($this->label['description'], "", ['class' => 'layui-form-label']);
            $content .= $this->inputBlock($label, $input);
        }

        $value = "";
        if (isset($this->value['content'])){
            $value = $this->value['content'];
        }

        $input = Html::textarea(sprintf("%s[content]", $this->name), $value);
        $label = Html::label($this->label['content'], "", ['class' => 'layui-form-label']);
        $input = UEditorInput::widget(['name' => sprintf("%s[content]", $this->name), 'value' => $value]);
        $content .= $this->inputBlock($label, $input);

        return $content;
    }

    private function inputBlock($labelHTML, $inputHTML) {
        $content = "";
        $content .= Html::beginTag("div", ['class' => "layui-form-item layui-form-text"]);

        if (isset($this->options['showLabel']) && $this->options['showLabel'] === false) {
            $this->label = "&nbsp";
        }
        $content .= $labelHTML;

        $itemClass = "layui-input-block";
        $content .= Html::beginTag("div", ['class' => $itemClass]);
        $content .= $inputHTML;
        $content .= Html::endTag("div");
        $content .= Html::endTag("div");

        return $content;
    }
}