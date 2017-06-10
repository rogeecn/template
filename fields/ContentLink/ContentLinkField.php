<?php
namespace fields\ContentLink;


use common\base\Field;
use common\base\IField;
use common\extend\BSHtml;

class ContentLinkField extends Field implements IField
{
    public $name        = "content_link";
    public $description = "内容链接";
    public $table       = "field_content_link";

    private $styleList = [
        'style01' => '蓝色',
        'style02' => '橙色',
    ];

    protected function getLabels()
    {
        return [
            [
                'name'    => 'style',
                'title'   => '风格',
                'default' => '风格',
            ],
            [
                'name'    => 'link',
                'title'   => '链接',
                'default' => '链接',
            ],
            [
                'name'    => 'tag',
                'title'   => '标签',
                'default' => '标签',
            ],
            [
                'name'    => 'content',
                'title'   => '内容',
                'default' => '内容',
            ],
        ];
    }

    protected function renderField()
    {
        // 如果存在ID说明是可以查询数据的
        $this->value = ['content' => '', 'link' => '', 'style' => '', 'tag' => ''];
        if (!empty($this->dataID)) {
            $this->value = $this->getData();
        }


        $content = "";

        $inputName = sprintf("%s[style]", $this->name);
        $content .= BSHtml::label($this->label['style']);
        $content .= BSHtml::dropDownList($inputName, $this->value['style'], $this->styleList);
        $content .= BSHtml::formItem($content);

        $inputName = sprintf("%s[tag]", $this->name);
        $content .= BSHtml::label($this->label['tag']);
        $content .= BSHtml::textInput($inputName, $this->value['tag']);
        $content .= BSHtml::formItem($content);

        $inputName = sprintf("%s[link]", $this->name);
        $content .= BSHtml::label($this->label['link']);
        $content .= BSHtml::textInput($inputName, $this->value['link']);
        $content .= BSHtml::formItem($content);

        $inputName = sprintf("%s[content]", $this->name);
        $content .= BSHtml::label($this->label['content']);
        $content .= BSHtml::textarea($inputName, $this->value['content']);
        $content .= BSHtml::formItem($content);

        return $content;
    }
}