<?php
namespace fields\image;


use common\base\Field;
use common\base\IField;
use common\extend\BSHtml;
use plugins\Uploader\Plugin;

class AjaxUploadField extends Field implements IField
{
    public $name        = "image";
    public $description = "ajax 图片上传";
    public $table       = "field_upload_image";

    public function getOptions()
    {
        return [
            [
                'type'   => 'textInput',
                'name'   => 'limitCount',
                'label'  => '图片上限',
                'value'  => 3,
                'config' => [
                    'placeholder' => '上传图片数量上限',
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();
        switch ($this->action) {
            case self::ACTION_CREATE:
            case self::ACTION_UPDATE:
                if (empty($this->fieldData['image'])) {
                    $this->fieldData['image'] = [];
                }
                $this->fieldData['image'] = implode(",", $this->fieldData['image']);
                break;
        }
    }

    protected function renderField()
    {
        // 如果存在ID说明是可以查询数据的
        $this->value = ['image' => ''];
        if (!empty($this->dataID)) {
            $this->value = $this->getData();
        }


        $content = "";
        $content .= BSHtml::label($this->label[$this->name]);

        $content .= Plugin::widget([
            'name'    => sprintf("%s[%s]", $this->name, $this->name),
            'value'   => array_filter(explode(",", $this->value['image'])),
            'options' => $this->options,
        ]);
        $content = BSHtml::formItem($content);

        return $content;
    }
}