<?php
namespace modules\tag\assets;


use yii\web\AssetBundle;


class TagAssets extends AssetBundle
{
    public $sourcePath = '@application/modules/assets/static/tag/dist';
    public $js         = [
        'jquery.tagsinput.min.js',
    ];
    public $css        = [
        'jquery.tagsinput.min.css',
    ];
    public $depends    = [
        'yii\jui\JuiAsset',
    ];
}