<?php
namespace fields\image;


use common\base\Field;
use common\base\IField;
use plugins\LayUI\components\Html;
use modules\uploader\widget\UploaderWidget;

class AjaxUploadField extends Field implements IField
{
    public $name        = "image";
    public $description = "ajax 图片上传";
    public $table       = "field_upload_image";

    public function getOptions() {
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

    public function init() {
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

    protected function renderField() {
        // 如果存在ID说明是可以查询数据的
        if (!empty($this->dataID)) {
            $this->value = $this->getData();
        }


        $content = "";
        $content .= Html::beginTag("div", ['class' => "layui-form-item layui-form-text"]);
        $content .= Html::label($this->label, "", ['class' => 'layui-form-label']);

        $itemClass = "layui-input-block";
        $input     = UploaderWidget::widget([
            'name'    => sprintf("%s[%s]", $this->name, $this->name),
            'value'   => explode(",", $this->value['image']),
            'options' => $this->options,
        ]);
        $content .= Html::tag("div", $input, ['class' => $itemClass]);
        $content .= Html::endTag("div");

        return $content;
    }
}