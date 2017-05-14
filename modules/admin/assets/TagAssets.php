<?php
namespace modules\admin\assets;

use yii\web\AssetBundle;
class TagAssets extends AssetBundle
{
    public $sourcePath = '@application/modules/admin/assets/static/tag/dist';
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