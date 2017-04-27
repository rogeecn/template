<?php
namespace common\extend;


class UserInfo
{
    public function Instance()
    {
        return \Yii::$app->getUser();
    }
    public static function isGuest()
    {
        return self::Instance()->getIsGuest();
    }

    public static function logout()
    {
        return self::Instance()->logout(true);
    }
}