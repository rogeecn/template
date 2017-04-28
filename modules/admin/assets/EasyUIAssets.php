<?php
namespace modules\admin\assets;


use yii\web\AssetBundle;

class EasyUIAssets extends AssetBundle
{
    public $basePath = '@webroot/libraries/jeasyui';
    public $baseUrl = '@web/libraries/jeasyui';
    public $js = [
        'jquery.easyui.min.js'
    ];
    public $css = [
        'themes/gray/easyui.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}