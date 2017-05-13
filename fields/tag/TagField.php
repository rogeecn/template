<?php
namespace fields\tag;


use application\modules\admin\widget\TagInput;
use common\base\Field;
use common\base\IField;
use common\models\TagArticle;
use LayUI\components\Html;
use yii\helpers\ArrayHelper;

class TagField extends Field implements IField
{
    public $name        = "tag";
    public $description = "tag标签管理";
    public $table       = "tag";

    public function getOptions() {
        return [
        ];
    }

    public function createData() {
        if (empty($this->fieldData['tag'])) {
            return;
        }

        $tags = explode(",", $this->fieldData['tag']);
        $tags = array_filter(array_unique($tags));
        TagArticle::setArticleTags($this->dataID, $tags);
    }

    public function updateData() {
        $tags = explode(",", $this->fieldData['tag']);
        $tags = array_filter(array_unique($tags));
        TagArticle::setArticleTags($this->dataID, $tags);
    }

    public function getData() {
        $articleTags = TagArticle::getArticleTags($this->dataID);
        $retData     = [
            'tag' => ArrayHelper::getColumn($articleTags, "name"),
        ];
        return $retData;
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
        $input     = TagInput::widget([
            'name'    => sprintf("%s[%s]", $this->name, $this->name),
            'value'   => implode(",", $this->value['tag']),
            'options' => $this->options,
        ]);
        $content .= Html::tag("div", $input, ['class' => $itemClass]);
        $content .= Html::endTag("div");

        return $content;
    }
}