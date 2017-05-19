<?php
namespace common\extend;


use common\models\Setting;
use yii\helpers\FileHelper;

class View extends \yii\web\View
{
    // site.name 点连接格式
    public function setting($configPath)
    {
        $settingCacheFile = \Yii::getAlias("@runtime/data/setting.php");
        if (!is_file($settingCacheFile)) {
            if (!is_dir(dirname($settingCacheFile))) {
                FileHelper::createDirectory(dirname($settingCacheFile));
            }
            $data = Setting::flatSettings();
            file_put_contents($settingCacheFile, json_encode($data));
        } else {
            $data = json_decode(file_get_contents($settingCacheFile), TRUE);
        }
        if (!isset($data[$configPath])) {
            return FALSE;
        }

        return $data[$configPath];
    }
}