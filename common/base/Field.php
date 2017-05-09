<?php
namespace common\base;


use yii\base\Widget;
use yii\widgets\InputWidget;

class Field extends Widget
{
    public function getInfo() {
        return [
            'class' => self::className(),
            'name' => $this->fieldName,
            'description' => $this->fieldDescription,
        ];
    }
}