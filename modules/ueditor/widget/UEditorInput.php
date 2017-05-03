<?php
namespace modules\ueditor\widget;


use modules\ueditor\assets\UEditorAssets;
use yii\base\InvalidParamException;
use yii\bootstrap\Html;
use yii\widgets\InputWidget;

class UEditorInput extends InputWidget
{
    public function run() {
        UEditorAssets::register($this->getView());

        $id = self::getId();
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, ['id' => $id]);
        } else {
            if (empty($this->name)) {
                throw new InvalidParamException("argument 'name' is required!");
            }
            echo Html::textarea($this->name, $this->value, ['id' => $id]);
        }

        $js = <<<_UEDITOR_
    var _ueditor = UE.getEditor("$id");
_UEDITOR_;

        $this->getView()->registerJs($js);
    }
}