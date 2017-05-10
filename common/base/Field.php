<?php
namespace common\base;


use yii\base\InvalidParamException;
use yii\base\Widget;

class Field extends Widget
{
    public $config = [];
    public $action = "";

    public $label = "";
    public $name = "";
    public $value = "";
    public $type = "textInput";
    public $description = "";
    public $table = "";
    public $options = [];

    public function init()
    {
        parent::init();
        $this->initParams();
    }

    protected function getInfo() {
        return [
            'class' => self::className(),
            'name' => $this->name,
            'table' => $this->table,
            'description' => $this->description,
        ];
    }

    public function initParams()
    {
        if (empty($this->action)){
            throw new InvalidParamException("missing params action");
        }

        foreach ($this->config as $itemKey=>$itemValue){
            if (!property_exists($this,$itemKey)){
                continue;
            }
            $this->$itemKey = $itemValue;
        }
        var_dump($this->options);exit;

        $this->options = json_decode($this->options);

    }
}