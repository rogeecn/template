<?php
namespace common\base;


use yii\base\InvalidParamException;
use yii\base\Widget;

class Field extends Widget
{
    public $config = [];
    public $action = "";

    public $label       = "";
    public $name        = "";
    public $value       = "";
    public $type        = "textInput";
    public $description = "";
    public $table       = "";
    public $options     = [];
    public $fieldData   = [];
    public $dataID      = null;

    public static function field($config = []) {
        try {
            /* @var $widget Widget */
            $config['class'] = get_called_class();
            $widget          = \Yii::createObject($config);
            $out             = '';
            if ($widget->beforeRun()) {
                $result = $widget->run();
                $out    = $widget->afterRun($result);
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return $out;
    }

    public function init() {
        parent::init();
        $this->initParams();
    }

    protected function getInfo() {
        return [
            'class'       => self::className(),
            'name'        => $this->name,
            'table'       => $this->table,
            'description' => $this->description,
            'options'     => $this->getOptions(),
        ];
    }

    public function initParams() {
        if (empty($this->action)) {
            throw new InvalidParamException("missing params action");
        }

        foreach ($this->config as $itemKey => $itemValue) {
            if (!property_exists($this, $itemKey)) {
                continue;
            }
            if ($itemKey == "options") {
                $this->$itemKey = json_decode($itemValue, true) ?: [];
                continue;
            }
            $this->$itemKey = $itemValue;
        }
    }

    protected function getOptions() {
        return [];
    }

    public function run() {
        return call_user_func_array([$this, $this->action], []);
    }

    public function createCommand($sql, $params = []) {
        return \Yii::$app->getDb()->createCommand($sql, $params);
    }
}