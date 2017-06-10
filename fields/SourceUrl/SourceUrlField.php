<?php
namespace fields\SourceUrl;


use common\base\Field;
use common\base\IField;
use common\extend\BSHtml;

class SourceUrlField extends Field implements IField
{
    public $name        = "source_url";
    public $description = "文章来源链接";
    public $table       = "field_article_source";

    protected function renderField()
    {
        // 如果存在ID说明是可以查询数据的
        $this->value = ['source_url' => ''];
        if (!empty($this->dataID)) {
            $this->value = $this->getData();
        }
        $inputName = sprintf("%s[source_url]", $this->name);

        $content = "";
        $content .= BSHtml::label($this->label[$this->name]);
        $content .= BSHtml::textInput($inputName, $this->value['source_url']);

        return BSHtml::formItem($content);
    }
}