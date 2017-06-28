<?php

namespace themes\basic\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@themes/basic/assets';
    public $baseUrl  = '/themes/basic/assets';
    public $css      = [
        'css/main.css',
    ];
    public $js       = [
    ];
    public $depends  = [
        'plugins\FontAwesome\FontAwesome',
        'yii\web\JqueryAsset',
    ];
}
