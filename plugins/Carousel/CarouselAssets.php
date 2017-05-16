<?php
namespace plugins\Carousel;

use yii\web\AssetBundle;

class CarouselAssets extends AssetBundle
{
    public $sourcePath = "@plugins/Carousel/static/slick";

    public $js = [
        "slick.js"
    ];

    public $css = [
        "slick.css",
        "slick-theme.css",
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}