<?php
namespace console\base;


use common\util\Logger;
use yii\console\Controller;

class ConsoleController extends Controller
{
    /** @var  \Monolog\Logger */
    protected static $_logger;

    public function beforeAction($action)
    {
        self::$_logger = Logger::instance($this->uniqueId);

        return parent::beforeAction($action);
    }
}