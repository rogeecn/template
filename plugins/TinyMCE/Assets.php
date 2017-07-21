<?php
namespace plugins\TinyMCE;


use yii\web\AssetBundle;

class Assets extends AssetBundle
{
    public $sourcePath = '@plugins/TinyMCE/static';
    public $js         = [
        'tinymce.min.js',
    ];
    public $css        = [
    ];
    public $depends    = [
    ];
}