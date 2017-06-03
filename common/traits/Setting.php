<?php
namespace common\traits;


use yii\helpers\FileHelper;

trait Setting
{
    private static $_SETTING;

    // site.name 点连接格式
    public function setting($configPath)
    {
        $settingCacheFile = \Yii::getAlias("@runtime/data/setting.php");
        if (empty(self::$_SETTING)) {
            if (!is_file($settingCacheFile)) {
                if (!is_dir(dirname($settingCacheFile))) {
                    FileHelper::createDirectory(dirname($settingCacheFile));
                }
                self::$_SETTING = \common\models\Setting::flatSettings();
                file_put_contents($settingCacheFile, json_encode(self::$_SETTING));
            } else {
                self::$_SETTING = json_decode(file_get_contents($settingCacheFile), TRUE);
            }
        }

        if (!isset(self::$_SETTING[$configPath])) {
            return FALSE;
        }

        return self::$_SETTING[$configPath];
    }
}