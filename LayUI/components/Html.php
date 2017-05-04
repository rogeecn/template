<?php
namespace LayUI\components;

use yii\helpers\ArrayHelper;
use yii\helpers\BaseHtml;

class Html extends BaseHtml
{
    public static function submitButton($content = '提交', $options = [])
    {
        if (!isset($options['class'])){
            self::addCssClass($options,"layui-btn");
        }

        return parent::submitButton($content,$options);
    }

    public static function buttonGroup($buttons = [])
    {
        return Html::tag("div",implode("\n",$buttons),['class'=>'layui-btn-group']);
    }

    public static function textInput($name, $value = '', $options = [])
    {
        self::addCssClass($options,["layui-input"]);
        return parent::textInput($name,$value,$options);
    }

    public static function textarea($name, $value = '', $options = [])
    {
        self::addCssClass($options,["layui-input"]);
        return parent::textarea($name,$value,$options);
    }

    public static function dropDownList($name, $selection = null, $items = [], $options = []){
        self::addCssClass($options,["layui-input"]);
        return parent::dropDownList($name,$selection,$items,$options);
    }

    public static function submitWrapper($content)
    {
        return  Html::tag("div",Html::tag("div",$content,['class'=>'layui-input-block']),['class'=>'layui-form-item']);
    }

    public static function hint($content)
    {
        return Html::tag("div",$content,['class'=>"layui-form-mid layui-word-aux"]);
    }

    public static function checkboxList($name, $selection = null, $items = [], $options = [])
    {
        self::addCssClass($options,["layui-input"]);
        if (!isset($options['lay-skin'])){
            $options['lay-skin'] = 'primary';
        }

        $itemList = [];
        foreach ($items as $key=>$item){
            $itemOption=$options;
            $itemOption['title']=$item;
            $itemOption['value']=$key;
            $itemList[] = Html::checkbox($name."[]",in_array($key,$selection),$itemOption);
        }
        return implode("\n",$itemList);
    }

    public static function radioList($name, $selection = null, $items = [], $options = [])
    {
        self::addCssClass($options,["layui-input"]);
        if (!isset($options['lay-skin'])){
            $options['lay-skin'] = 'primary';
        }

        $itemList = [];
        foreach ($items as $key=>$item){
            $itemOption=$options;
            $itemOption['title']=$item;
            $itemOption['value']=$key;
            $itemList[] = Html::radio($name,$key==$selection,$itemOption);
        }
        return implode("\n",$itemList);
    }
}
