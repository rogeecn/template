<?php
namespace modules\ueditor\assets;


use yii\web\AssetBundle;

class UEditorAssets extends AssetBundle
{
    public $basePath = '@webroot/libraries/ueditor';
    public $baseUrl = '@web/libraries/ueditor';
    public $js = [
        'ueditor.config.js?v=1.0.1',
        'ueditor.all.min.js',
    ];
    public $css = [
    ];
    public $depends = [
    ];
}