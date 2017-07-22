<?php
namespace plugins\TinyMCE;


use common\extend\Html;
use yii\base\InvalidParamException;
use yii\widgets\InputWidget;

class Editor extends InputWidget
{
    public function init()
    {
        Assets::register($this->getView());
    }

    public function run()
    {
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

        $js = strtr($this->renderFile(__DIR__ . "/config.js"), [
            '{id}' => $id,
        ]);

        $this->getView()->registerJs($js);

        return $html;
    }
}