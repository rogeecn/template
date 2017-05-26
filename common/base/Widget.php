<?php
namespace common\base;


use common\extend\View;

class Widget extends \yii\base\Widget
{
    /** @var  View */
    protected        $view;
    protected static $_CACHE;

    public function init()
    {
        $this->view = $this->getView();
        parent::init();
    }

    public static function setCache($key, $value)
    {
        self::$_CACHE[$key] = $value;
    }

    public static function getCache($key)
    {
        if (!isset(self::$_CACHE[$key])) {
            return FALSE;
        }

        return self::$_CACHE[$key];
    }
}