<?php

namespace application\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@web';
    public $baseUrl  = '@web';
    public $css       = [
        'css/main.css'
    ];
    public $js       = [
    ];
    public $depends  = [
        'plugins\FontAwesome\FontAwesome',
        'yii\web\JqueryAsset',
    ];
}
