<?php
namespace common\extend;


use yii\bootstrap\Html;

class BSHtml extends \common\extend\Html
{
    public static function formItem($content, $options = [])
    {
        if (!isset($options['clasa'])) {
            $options['class'] = '';
        }

        self::addCssClass($options, "form-group");

        return self::div($content, $options);
    }

    public static function textarea($name, $value = '', $options = [])
    {
        self::addCssClass($options, ['form-control']);

        return Html::textarea($name, $value, $options);
    }

    public static function submitButton($content = 'Submit', $options = [])
    {
        self::addCssClass($options, 'btn btn-primary');

        return parent::submitButton($content, $options);
    }
}