<?php
/**
 * 封装请求参数获取
 */
namespace common\util;
class Request
{
    private static function getRequest()
    {
        return \Yii::$app->getRequest();
    }

    public static function rawInput()
    {
        return self::getRequest()->getRawBody();
    }

    public static function input($param = NULL, $default = NULL)
    {
        $val = self::cookie($param, NULL);
        if ($val !== NULL) {
            return self::cookie($param, $default);
        }

        $val = self::post($param, NULL);
        if ($val !== NULL) {
            return self::post($param, $default);
        }

        return self::get($param, $default);
    }

    public static function get($param = NULL, $default = NULL)
    {
        return self::getRequest()->get($param, $default);
    }

    public static function queryParams()
    {
        return self::getRequest()->getQueryParams();
    }

    public static function post($param = NULL, $default = NULL)
    {
        return self::getRequest()->post($param, $default);
    }

    public static function isAjax()
    {
        return self::getRequest()->getIsAjax();
    }

    public static function isPost()
    {
        return self::getRequest()->getIsPost();
    }

    public static function isPut()
    {
        return self::getRequest()->getIsPut();
    }

    public static function isPjax()
    {
        return self::getRequest()->getIsPjax();
    }

    public static function ip()
    {
        return self::getRequest()->getUserIP();
    }

    public static function getHostInfo()
    {
        return self::getRequest()->getHostInfo();
    }

    public static function cookie($key, $default = NULL)
    {
        return self::getRequest()->getCookies()->getValue($key, $default);
    }

    public static function pathInfo()
    {
        return self::getRequest()->getPathInfo();
    }
}