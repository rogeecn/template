<?php

namespace application\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';
    public $css       = [
    ];
    public $js       = [
    ];
    public $depends  = [
        'yii\web\JqueryAsset',
        'plugins\LayUI\LayUIAssets',
    ];
}
