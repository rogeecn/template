<?php
namespace common\util;


use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;

class Logger
{
    /** @var  \Monolog\Logger[] */
    private static $_logger;

    public static function instance($name = 'application')
    {
        if (!isset(self::$_logger[$name])) {
            $logger = new \Monolog\Logger($name);

            $file_path = sprintf("%s/logs/%s.log", \Yii::getAlias("@runtime"), $name);
            $logger->pushHandler(new RotatingFileHandler($file_path, 7));
            $logger->pushHandler(new StreamHandler('php://stdout'));


            self::$_logger[$name] = $logger;
        }

        return self::$_logger[$name];
    }
}