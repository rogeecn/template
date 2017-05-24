<?php
namespace fields\Announcement;


use common\base\Field;
use common\base\IField;
use plugins\LayUI\components\Html;

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

        $content = "";

        $content .= Html::beginTag("div", ['class' => "layui-form-item layui-form-text"]);
        $content .= Html::label($this->label, "", ['class' => 'layui-form-label']);
        $input = Html::checkbox(sprintf("%s[checked]", $this->name), $checked, ['lay-skin' => 'primary']);
        $content .= Html::tag("div", $input, ['class' => "layui-input-block"]);
        $content .= Html::endTag("div");

        return $content;
    }
}