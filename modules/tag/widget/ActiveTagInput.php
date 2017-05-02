<?php
namespace modules\tag\widget;


use modules\tag\assets\TagAssets;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class ActiveTagInput extends InputWidget
{
    public $tags = [];
    public function init()
    {

    }

    public function run()
    {
        $id = self::getId(true);
        TagAssets::register($this->getView());
        echo Html::textInput($this->name,implode(",",$this->tags),['id'=>$id]);

        $js = <<<_JS_
$('#$id').tagsInput({
  autocomplete_url: '/tag/complete',
  autocomplete: {
    selectFirst:true,
    width:'100px',
    autoFill:true
  },
  'width':'auto', 
  'height':'auto', 
});
_JS_;

        $this->getView()->registerJs($js);
    }
}