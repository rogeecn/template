<?php
/**
 * 封装请求参数获取
 * User: yanghao-c
 */

namespace common\util;

use yii\web\Cookie;

class Response
{
    public static function getResponse()
    {
        return \Yii::$app->getResponse();
    }

    public static function getCookies()
    {
        return self::getResponse()->getCookies();
    }

    public static function setCookie($key, $value)
    {
        $cookies = self::getCookies();
        if (isset($cookies[$key])) {
            $cookies[$key] = $value;

            return;
        }

        $cookies->add(new Cookie([
            'name'  => $key,
            'value' => $value,
        ]));
    }

    public static function removeCookie($key)
    {
        return self::getCookies()->remove($key);
    }

    public static function clearCookie()
    {
        return self::getCookies()->removeAll();
    }
}