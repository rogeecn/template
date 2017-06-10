<?php
namespace common\extend;


use yii\bootstrap\Html;

class BSHtml extends \common\extend\Html
{
    public static function buttonGroup($buttons = [], $options = [])
    {
        self::addCssClass($options, 'btn-group');

        return self::div(implode("\n", $buttons), $options);
    }

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
        self::addFormClass($options);

        return Html::textarea($name, $value, $options);
    }

    public static function submitButton($content = '提交', $options = [])
    {
        self::addCssClass($options, 'btn btn-primary');

        return parent::submitButton($content, $options);
    }

    public static function dropDownList($name, $selection = null, $items = [], $options = [])
    {
        self::addFormClass($options);

        return Html::dropDownList($name, $selection, $items, $options);
    }

    public static function textInput($name, $value = null, $options = [])
    {
        self::addCssClass($options, "form-control");

        return parent::textInput($name, $value, $options);
    }

    public static function activeTextInput($model, $attribute, $options = [])
    {
        self::addFormClass($options);

        return parent::activeTextInput($model, $attribute, $options);
    }

    public static function activeDropDownList($model, $attribute, $items, $options = [])
    {
        self::addFormClass($options);

        return parent::activeDropDownList($model, $attribute, $items, $options);
    }

    public static function buttonLink($content, $url = "#", $options = [])
    {
        self::addCssClass($options, ["btn", 'btn-default']);
        if (isset($options['icon'])) {
            $content = self::icon($options['icon']) . "&nbsp;" . $content;
        }

        return Html::a($content, $url, $options);
    }

    public static function resetButtonLink($content = '重置', $url = [], $options = [])
    {
        return self::buttonLink($content, $url, $options);
    }

    public static function resetButton($content = '重置', $options = [])
    {
        self::addCssClass($options, ["btn", 'btn-default']);

        return parent::resetButton($content, $options);
    }

    private static function addFormClass(&$options)
    {
        self::addCssClass($options, "form-control");
    }

    public static function hint($content, $options = [])
    {
        self::addCssClass($options, 'help-block');

        return self::div($content, $options);
    }

    public static function createFormElement($inputType, $label, $name, $value, $options = [])
    {
        return self::formElement($inputType, "inline", $label, $name, $value, $options);
    }

    private static function formElement($inputType, $type, $label, $name, $value, $options = [])
    {
        $htmlTemplate = self::formItem(self::label("{label}") . "{input}");

        $inputHtml = "";
        $labelHtml = self::label($label);
        switch ($inputType) {
            case 'textInput':
            case 'textarea':
                $inputHtml = self::$inputType($name, $value, $options);
                break;
            case 'checkbox':
            case 'radio':
                $labelHtml = "";
                if (!isset($options['title'])) {
                    $options['title'] = $label;
                }
                $inputHtml = self::$inputType($name, $value, $options) . $options['title'];

                $htmlTemplate = self::formItem(self::label("{label}{input}"));
                break;
            case 'dropDownList':
            case 'radioList':
                $inputHtml = self::$inputType($name, $value, $options);
                break;
        }

        return strtr($htmlTemplate, [
            '{label}' => $labelHtml,
            '{input}' => $inputHtml,
        ]);
    }
}