<?php
namespace common\base;


use yii\base\Widget;

class Field extends Widget
{
    public function getInfo() {
        return [
            'class' => self::className(),
            'name' => $this->fieldName,
            'table' => $this->defaultTable,
            'description' => $this->fieldDescription,
        ];
    }
}