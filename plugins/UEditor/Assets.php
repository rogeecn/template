<?php
namespace plugins\UEditor;


use yii\web\AssetBundle;

class Assets extends AssetBundle
{
    public $sourcePath = '@plugins/UEditor/static';
    public $js         = [
        'ueditor.config.js?v=1.0.1',
        'ueditor.all.min.js',
    ];
    public $css        = [
    ];
    public $depends    = [
    ];
}