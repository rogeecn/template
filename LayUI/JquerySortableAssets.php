<?php
namespace LayUI;

use yii\web\AssetBundle;

class JquerySortableAssets extends AssetBundle
{
    public $sourcePath = "@LayUI/assets/jquery-sortable";

    public $js = [
        "jquery-sortable.min.js"
    ];

    public $css = [
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}