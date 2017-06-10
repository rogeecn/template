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

    public static function icon($name, $content = "", $options = [])
    {
        $classPrefix = "fa fa-";
        $fontClass   = $classPrefix . $name;

        Html::addCssClass($options, $fontClass);

        return self::tag("i", $content, $options);
    }

    public static function dragIcon()
    {
        return self::icon("arrows", "", ['class' => 'drag-handle']);
    }
}