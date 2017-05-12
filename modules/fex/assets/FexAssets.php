<?php
namespace modules\fex\assets;


use yii\web\AssetBundle;

class FexAssets extends AssetBundle
{
    public $sourcePath = '@modules/fex/static';
    public $js         = [
        'webuploader.js',
    ];
    public $css        = [
        'webuploader.css',
    ];
    public $depends    = [
    ];
}