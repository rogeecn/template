<?php
namespace plugins\FontAwesome;

use yii\web\AssetBundle;

class FontAwesome extends AssetBundle
{
    public $sourcePath = "@plugins/FontAwesome/static";

    public $js = [
    ];

    public $css = [
        "css/font-awesome.min.css"
    ];

    public $depends = [
    ];
}