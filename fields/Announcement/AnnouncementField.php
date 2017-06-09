<?php
namespace fields\Announcement;


use common\base\Field;
use common\base\IField;
use yii\bootstrap\Html;

class AnnouncementField extends Field implements IField
{
    public $name        = "announcement";
    public $description = "设置为公告";
    public $table       = "field_announcement_article";

    public function init()
    {
        parent::init();
        if (empty($this->fieldData)) {
            $this->fieldData = ['checked' => 0];
        }
    }

    protected function renderField()
    {
        $this->value = ['id' => '', 'checked' => ''];
        // 如果存在ID说明是可以查询数据的
        if (!empty($this->dataID)) {
            $this->value = $this->getData();
        }


        $checked = FALSE;
        if ($this->dataID) {
            $checked = $this->value['checked'] == 1;
        }

        $inputName = sprintf("%s[checked]", $this->name);

        $checkBox = Html::checkbox($inputName, $checked);
        $checkBox = Html::label($checkBox . $this->label);

        return Html::tag("div", $checkBox, ['class' => 'form-group checkbox']);
    }
}