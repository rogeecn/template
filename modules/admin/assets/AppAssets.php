<?php
namespace modules\admin\assets;


use yii\web\AssetBundle;

class AppAssets extends AssetBundle
{
    public $sourcePath = '@modules/admin/assets/static/custom';
    public $css  =[
      'css/admin.css'
    ];
    public $depends = [
        'LayUI\LayUIAssets',
        'yii\web\JqueryAsset',
    ];
}