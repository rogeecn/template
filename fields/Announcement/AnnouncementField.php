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
    }

    protected function renderField()
    {
        // 如果存在ID说明是可以查询数据的
        if (!empty($this->dataID)) {
            $this->value = $this->getData();
        }


        $content = "";

        $content .= Html::beginTag("div", ['class' => "layui-form-item layui-form-text"]);
        $content .= Html::label($this->label, "", ['class' => 'layui-form-label']);
        $input = Html::checkbox(sprintf("%s[id]", $this->name), ($this->dataID == $this->value['id']), ['lay-skin' => 'primary']);
        $content .= Html::tag("div", $input, ['class' => "layui-input-block"]);
        $content .= Html::endTag("div");

        return $content;
    }
}