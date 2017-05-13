<?php
namespace LayUI\components;

use modules\ueditor\widget\UEditorInput;
use yii\helpers\BaseHtml;
use yii\helpers\Url;

class Html extends BaseHtml
{
    public static function inlineFormItem($inputType, $label, $name, $value, $options = []) {
        return self::formItem($inputType, "inline", $label, $name, $value, $options);
    }

    public static function blockFormItem($inputType, $label, $name, $value, $options = []) {
        return self::formItem($inputType, "block", $label, $name, $value, $options);
    }

    private static function formItem($inputType, $type, $label, $name, $value, $options = []) {

        $inputWrapper = self::tag("div", "{input}", ['class' => "layui-input-" . $type]);
        $htmlTemplate = self::tag("div", "{label}" . $inputWrapper, ['class' => "layui-form-item"]);

        $inputHtml = "";
        $labelHtml = self::label($label, "", ['class' => "layui-form-label"]);
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
                $inputHtml = self::$inputType($name, $value, $options);
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

    public static function a($text, $url = null, $options = []) {
        if ($url !== null) {
            $options['href'] = Url::to($url, true);
        }
        return self::tag('a', $text, $options);
    }

    public static function activeEditor($model, $attribute, $options = []) {
        return UEditorInput::widget(['model' => $model, 'attribute' => $attribute, 'options' => $options]);
    }

    public static function submitButton($content = '提交', $options = []) {
        if (!isset($options['class'])) {
            self::addCssClass($options, "layui-btn");
        }

        return parent::submitButton($content, $options);
    }

    public static function linkButton($text, $url = null, $options = []) {
        if ($url !== null) {
            $options['href'] = Url::to($url, true);
        }

        $options['class'] = "layui-btn ";
        if (isset($options['color'])) {
            self::addCssClass($options, "layui-" . $options['color']);
        }
        return self::tag('a', $text, $options);
    }

    public static function resetButton($content = '重置', $options = []) {
        if (!isset($options['class'])) {
            self::addCssClass($options, "layui-btn layui-btn-primary");
        }

        return parent::resetButton($content, $options);
    }

    public static function resetButtonLink($content = '重置', $link = [], $options = []) {
        if (!isset($options['class'])) {
            self::addCssClass($options, "layui-btn layui-btn-primary");
        }

        return Html::a($content, $link, $options);
    }

    public static function buttonGroup($buttons = []) {
        return Html::tag("div", implode("\n", $buttons), ['class' => 'layui-btn-group']);
    }

    public static function activeTextInput($model, $attribute, $options = []) {
        if (isset($options['class'])) {
            $options['class'] = 'layui-input ' . $options['class'];
        } else {
            $options['class'] = 'layui-input';
        }

        return parent::activeInput('text', $model, $attribute, $options);
    }

    public static function textInput($name, $value = '', $options = []) {
        self::addCssClass($options, ["layui-input"]);
        return parent::textInput($name, $value, $options);
    }

    public static function radio($name, $checked = false, $options = []) {
        return self::booleanInput('radio', $name, $checked, $options);
    }

    public static function checkbox($name, $checked = false, $options = []) {
        return self::booleanInput('checkbox', $name, $checked, $options);
    }

    public static function textarea($name, $value = '', $options = []) {
        self::addCssClass($options, ["layui-textarea"]);
        return parent::textarea($name, $value, $options);
    }

    public static function dropDownList($name, $selection = null, $items = [], $options = []) {
        self::addCssClass($options, ["layui-input"]);
        return parent::dropDownList($name, $selection, $items, $options);
    }

    public static function submitWrapper($content) {
        return Html::tag("div", Html::tag("div", $content, ['class' => 'layui-input-block']), ['class' => 'layui-form-item']);
    }

    public static function hint($content) {
        return Html::tag("div", $content, ['class' => "layui-form-mid layui-word-aux"]);
    }

    public static function checkboxList($name, $selection = null, $items = [], $options = []) {
        self::addCssClass($options, ["layui-input"]);
        if (!isset($options['lay-skin'])) {
            $options['lay-skin'] = 'primary';
        }

        $itemList = [];
        foreach ($items as $key => $item) {
            $itemOption          = $options;
            $itemOption['title'] = $item;
            $itemOption['value'] = $key;
            $itemList[]          = Html::checkbox($name . "[]", in_array($key, $selection), $itemOption);
        }
        return implode("\n", $itemList);
    }

    public static function radioList($name, $selection = null, $items = [], $options = []) {
        self::addCssClass($options, ["layui-input"]);
        if (!isset($options['lay-skin'])) {
            $options['lay-skin'] = 'primary';
        }

        $itemList = [];
        foreach ($items as $key => $item) {
            $itemOption          = $options;
            $itemOption['title'] = $item;
            $itemOption['value'] = $key;
            $itemList[]          = Html::radio($name, $key == $selection, $itemOption);
        }
        return implode("\n", $itemList);
    }

    public static function activeRadio($model, $attribute, $options = []) {
        return self::activeBooleanInput('radio', $model, $attribute, $options);
    }

    public static function activeCheckbox($model, $attribute, $options = []) {
        return self::activeBooleanInput('checkbox', $model, $attribute, $options);
    }


    public static function activeRadioList($model, $attribute, $items, $options = []) {
        return self::activeListInput('radioList', $model, $attribute, $items, $options);
    }

    public static function activeCheckboxList($model, $attribute, $items, $options = []) {
        return self::activeListInput('checkboxList', $model, $attribute, $items, $options);
    }

    public static function icon($icon, $options = []) {
        self::addCssClass($options, ['class' => 'layui-icon']);
        return self::tag("i", $icon, $options);
    }


    protected static function activeListInput($type, $model, $attribute, $items, $options = []) {
        $name      = isset($options['name']) ? $options['name'] : self::getInputName($model, $attribute);
        $selection = isset($options['value']) ? $options['value'] : self::getAttributeValue($model, $attribute);
        if (!array_key_exists('unselect', $options)) {
            $options['unselect'] = '';
        }
        if (!array_key_exists('id', $options)) {
            $options['id'] = self::getInputId($model, $attribute);
        }

        return self::$type($name, $selection, $items, $options);
    }

    protected static function activeBooleanInput($type, $model, $attribute, $options = []) {
        $name  = isset($options['name']) ? $options['name'] : self::getInputName($model, $attribute);
        $value = self::getAttributeValue($model, $attribute);

        $options['title'] = isset($options['title']) ? $options['title'] : $name;
        if (!array_key_exists('value', $options)) {
            $options['value'] = '1';
        }
        if (!array_key_exists('uncheck', $options)) {
            $options['uncheck'] = '0';
        }
        if (!array_key_exists('label', $options)) {
            $options['label'] = self::encode($model->getAttributeLabel(self::getAttributeName($attribute)));
        }

        $checked = "$value" === "{$options['value']}";

        if (!array_key_exists('id', $options)) {
            $options['id'] = self::getInputId($model, $attribute);
        }

        return self::$type($name, $checked, $options);
    }

    protected static function booleanInput($type, $name, $checked = false, $options = []) {
        $options['checked'] = (bool)$checked;
        $value              = array_key_exists('value', $options) ? $options['value'] : '1';
        if (isset($options['uncheck'])) {
            // add a hidden field so that if the checkbox is not selected, it still submits a value
            $hidden = self::hiddenInput($name, $options['uncheck']);
            unset($options['uncheck']);
        } else {
            $hidden = '';
        }

        return $hidden . self::input($type, $name, $value, $options);
    }
}
