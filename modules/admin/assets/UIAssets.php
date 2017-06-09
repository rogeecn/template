<?php
namespace modules\admin\assets;


use yii\web\AssetBundle;


class UIAssets extends AssetBundle
{
    public $sourcePath = '@modules/admin/assets/static/custom';
    public $css        = [
        'css/admin.css',
    ];
    public $depends    = [
        'plugins\LayUI\LayUIAssets',
        'yii\web\JqueryAsset',
        'plugins\FontAwesome\FontAwesome',
    ];
}