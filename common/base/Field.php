<?php
namespace common\base;


use yii\db\Exception;
use yii\base\InvalidParamException;
use yii\base\Widget;
use yii\db\Query;

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

    const ACTION_CREATE = 'createData';
    const ACTION_UPDATE = 'updateData';
    const ACTION_DELETE = 'deleteData';
    const ACTION_GET = 'getData';
    const ACTION_INFO = 'getInfo';
    const ACTION_RENDER = 'renderField';

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

    protected function createCommand($sql=null, $params = []) {
        return \Yii::$app->getDb()->createCommand($sql, $params);
    }

    protected function getQuery()
    {
        return (new Query());
    }

    protected function getData(){
        return $this->getQuery()
            ->from($this->table)
            ->where(['id'=>$this->dataID])
            ->one();
    }

    protected function createData() {
        $this->fieldData['id'] = $this->dataID;
        $ret = $this->createCommand()->insert($this->table,$this->fieldData)->execute();

        if (!$ret) {
            throw new Exception("table '$this->table': create data failed!");
        }
    }


    protected function updateData() {
        $this->createCommand()->update($this->table,$this->fieldData,['id'=>$this->dataID])->execute();
    }

    protected function deleteData() {
        $this->createCommand()->delete($this->table,["id"=>$this->dataID])->execute();
    }
}