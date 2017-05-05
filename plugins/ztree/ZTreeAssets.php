<?php
namespace plugins\ztree;

use yii\web\AssetBundle;

class ZTreeAssets extends AssetBundle
{
    public $sourcePath = "@plugins/ztree/assets";

    public $js = [
        "js/jquery.ztree.all.js"
    ];

    public $css = [
        "css/zTreeStyle/zTreeStyle.css"
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}