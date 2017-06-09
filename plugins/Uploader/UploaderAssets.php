<?php

namespace plugins\uploader;

use yii\web\AssetBundle;

class UploaderAssets extends AssetBundle
{
    public $sourcePath = '@plugins/Uploader/static';
    public $css        = [
//        'css/uploadfile.css?version=1',
    ];
    public $js         = [
        'js/jquery.uploadfile.min.js',
    ];
    public $depends    = [
        'yii\web\JqueryAsset',
    ];
}

