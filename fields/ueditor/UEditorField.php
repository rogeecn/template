<?php
namespace fields\ueditor;


use common\base\Field;
use common\base\IField;
use LayUI\components\Html;
use modules\ueditor\widget\UEditorInput;

class UEditorField extends Field implements IField
{
    public $name = "ueditor";
    public $description = "UEditor 富文本编辑器";
    public $table = "article_data";

    public function run()
    {
        return call_user_func_array([$this,$this->action],[]);
    }

    private function renderField()
    {
        $content = "";
        $content.= Html::beginTag("div",['class'=>"layui-form-item"]);
        var_dump($this->options);exit;
        if (isset($this->options['showLabel']) && $this->options['showLabel'] === true){
            $content .= Html::tag("div",$this->label,['class'=>'layui-form-label']);
        }

        $itemClass = "layui-form-block";
        if (isset($this->options['inline']) && $this->options['inline'] === true){
            $itemClass = 'layui-form-inline';
        }
         $content .= Html::beginTag("div",['class'=>$itemClass]);
        $content .=  UEditorInput::widget(['name'=>$this->name,'value'=>$this->value]);
        $content .=  Html::endTag("div");
        $content .=  Html::endTag("div");

        return $content;
    }
}