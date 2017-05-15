<?php
namespace plugins\LayUI\components;


use plugins\LayUI\LayUIAssets;

class GridView extends \yii\grid\GridView
{
    public $tableOptions = ['class' => 'layui-table'];
    public $pager = [
        'class' => 'plugins\LayUI\components\LinkPager'
    ];

    public function init() {
        LayUIAssets::register($this->getView());
        parent::init();
    }
}