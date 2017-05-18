<?php
namespace common\extend;


class Html extends \yii\helpers\Html
{
    public static function div($content = '', $options = [])
    {
        return self::tag("div", $content, $options);
    }

    public static function li($content = "", $options = [])
    {
        return self::tag("li", $content, $options);
    }

    public static function icon($name, $content = "")
    {
        $classPrefix = "fa fa-";
        $fontClass   = $classPrefix . $name;

        return self::tag("i", $content, ['class' => $fontClass]);
    }
}