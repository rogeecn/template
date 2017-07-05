<?php
namespace common\util;


class Util
{
    public static function convertToThemeFile($filePath)
    {
        $deviceType = \Yii::getAlias("@device");
        if ($deviceType == "desktop") {
            return $filePath;
        }

        $deviceFile = sprintf("%s_%s%s", substr($filePath, 0, -4), \Yii::getAlias("@device"), substr($filePath, -4));
        if (file_exists($deviceFile)) {
            return $deviceFile;
        }

        return $filePath;
    }
}