<?php
namespace modules\admin\assets;


use yii\web\AssetBundle;

class EasyUIAssets extends AssetBundle
{
    public $sourcePath = '@modules/admin/static';
    public $js         = [
        'jquery.easyui.min.js',
    ];
    public $css        = [
        'themes/gray/easyui.css',
    ];
    public $depends    = [
        'yii\web\JqueryAsset',
    ];
}