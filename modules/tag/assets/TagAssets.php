<?php
namespace modules\tag\assets;


use yii\web\AssetBundle;


class TagAssets extends AssetBundle
{
    public $sourcePath = '@modules/tag/static/dist';
    public $js = [
        'jquery.tagsinput.min.js'
    ];
    public $css = [
        'jquery.tagsinput.min.css'
    ];
    public $depends = [
        'yii\jui\JuiAsset',
    ];
}