<?php
namespace modules\admin\assets;


use yii\web\AssetBundle;

class AppAssets extends AssetBundle
{
    public $sourcePath = "@modules/admin/static";
    public $css  =[
      'css/admin.css'
    ];
    public $depends = [
        'LayUI\LayUIAssets',
        'yii\web\JqueryAsset',
    ];
}