<?php
namespace modules\admin\widget;


use modules\admin\assets\TagAssets;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class TagInput extends InputWidget
{
    public function run() {
        $id = self::getId(true);
        TagAssets::register($this->getView());
        echo Html::textInput($this->name, $this->value, ['id' => $id]);

        $js = <<<_JS_
$('#$id').tagsInput({
  autocomplete_url: '/admin/tag/complete',
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