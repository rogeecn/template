<?php
namespace plugins\sortable;

use yii\web\AssetBundle;

class SortableAssets extends AssetBundle
{
    public $sourcePath = "@plugins/sortable/assets";

    public $js = [
        "jquery-sortable.min.js"
    ];

    public $css = [
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}