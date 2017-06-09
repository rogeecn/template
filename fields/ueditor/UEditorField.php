<?php
namespace fields\ueditor;


use common\base\Field;
use common\base\IField;
use common\extend\BSHtml;
use modules\ueditor\widget\UEditorInput;
use yii\helpers\HtmlPurifier;

class UEditorField extends Field implements IField
{
    public $name        = "ueditor";
    public $description = "UEditor 富文本编辑器";
    public $table       = "field_content_data";

    protected function getOptions()
    {
        return [
            [
                'type'   => 'checkbox',
                'name'   => 'showDescription',
                'value'  => FALSE,
                'config' => [
                    'title'    => '使用概要输入',
                    'lay-skin' => 'primary',
                ],
            ],
            [
                'type'   => 'checkbox',
                'name'   => 'showLabel',
                'value'  => FALSE,
                'config' => [
                    'title'    => '显示标签',
                    'lay-skin' => 'primary',
                ],
            ],
        ];
    }

    protected function getData()
    {
        $fields = "*";
        if ($this->mode && $this->mode == self::MODE_SUMMARY) {
            $fields = "id,description";
        }

        return $this->getQuery()
                    ->from($this->table)
                    ->select($fields)
                    ->where(['id' => $this->dataID])
                    ->one();
    }

    protected function beforeSave($insert = FALSE)
    {
        parent::beforeSave($insert);

        $content = $this->fieldData['content'];

        $replacements                   = [
            '&nbsp;'    => " ",
            'bitCN.com' => "",
        ];
        $this->fieldData['description'] = strtr(trim($this->fieldData['description']), $replacements);

        $allowTags                  = 'p,b,a[href],pre,code,i,ul,li,ol,dl,dt,span,hr,h2,h3,h4,h5,h6,strong,div,br,img[src]';
        $content                    = strtr($content, $replacements);
        $this->fieldData['content'] = HtmlPurifier::process($content, [
            'HTML.Allowed'           => $allowTags,
            'AutoFormat.RemoveEmpty' => TRUE,
        ]);
    }


    protected function renderField()
    {
        $this->label = json_decode($this->label, TRUE);

        // 如果存在ID说明是可以查询数据的
        if (!empty($this->dataID)) {
            $this->value = $this->getData();
        }
        $content = "";
        if ($this->options['showDescription']) {
            $value = "";
            if (isset($this->value['description'])) {
                $value = $this->value['description'];
            }

            $inputName = sprintf("%s[description]", $this->name);
            $input     = BSHtml::textarea($inputName, $value, ['class' => 'form-control', 'rows' => 3]);
            $label     = BSHtml::label($this->label['description']);
            $content .= $this->inputBlock($label, $input);
        }

        $value = "";
        if (isset($this->value['content'])) {
            $value = $this->value['content'];
        }


        $label     = BSHtml::label($this->label['content']);
        $inputName = sprintf("%s[content]", $this->name);
        $input     = UEditorInput::widget(['name' => $inputName, 'value' => $value]);
        $content .= $this->inputBlock($label, $input);

        return $content;
    }

    private function inputBlock($labelHTML, $inputHTML)
    {
        $content = "";
        if (isset($this->options['showLabel']) && $this->options['showLabel'] === FALSE) {
            $this->label = "&nbsp";
        }
        $content .= $labelHTML;
        $content .= $inputHTML;

        return BSHtml::formItem($content);
    }
}