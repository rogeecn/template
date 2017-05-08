<?php
namespace LayUI\components;


use LayUI\LayUIAssets;

class GridView extends \yii\grid\GridView
{
    public $tableOptions = ['class' => 'layui-table'];
    public $pager = [
        'class' => 'LayUI\components\LinkPager'
    ];

    public function init() {
        LayUIAssets::register($this->getView());
        parent::init();
    }
}