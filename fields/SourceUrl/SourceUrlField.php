<?php
namespace fields\SourceUrl;


use common\base\Field;
use common\base\IField;
use modules\uploader\widget\UploaderWidget;
use plugins\LayUI\components\Html;

class SourceUrlField extends Field implements IField
{
    public $name        = "source_url";
    public $description = "文章来源链接";
    public $table       = "field_article_source";

    public function getOptions()
    {
        return [
        ];
    }

    protected function renderField()
    {
        // 如果存在ID说明是可以查询数据的
        $this->value = ['source_url' => ''];
        if (!empty($this->dataID)) {
            $this->value = $this->getData();
        }


        $content = "";
        $content .= Html::beginTag("div", ['class' => "layui-form-item layui-form-text"]);
        $content .= Html::label($this->label, "", ['class' => 'layui-form-label']);
        $input = Html::textInput(sprintf("%s[source_url]", $this->name), $this->value['source_url']);
        $content .= Html::tag("div", $input, ['class' => "layui-input-block"]);
        $content .= Html::endTag("div");

        return $content;
    }
}