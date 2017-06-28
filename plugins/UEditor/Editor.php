<?php
namespace plugins\UEditor;


use yii\base\InvalidParamException;
use yii\bootstrap\Html;
use yii\widgets\InputWidget;

class Editor extends InputWidget
{
    public function run()
    {
        Assets::register($this->getView());

        $html = "";
        $id   = self::getId();
        if ($this->hasModel()) {
            $html .= Html::activeTextarea($this->model, $this->attribute, ['id' => $id]);
        } else {
            if (empty($this->name)) {
                throw new InvalidParamException("argument 'name' is required!");
            }
            $html .= Html::textarea($this->name, $this->value, ['id' => $id]);
        }

        $js = <<<_UEDITOR_
    var _editor = UE.getEditor("$id");
_UEDITOR_;
        $this->getView()->registerJs($js);

        return $html;
    }
}