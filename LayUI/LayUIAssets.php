<?php
namespace LayUI;

use yii\web\AssetBundle;

class LayUIAssets extends AssetBundle
{
    public $sourcePath = "@LayUI/assets/build";

    public $js = [
//        "layui.js"
        "lay/dest/layui.all.js"
    ];

    public $css = [
        "css/layui.css",
        "custom.css",
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}