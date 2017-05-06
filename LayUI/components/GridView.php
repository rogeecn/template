<?php
namespace LayUI\components;


class GridView extends \yii\grid\GridView
{
    public $tableOptions = ['class' => 'layui-table'];
    public $pager = [
        'class' => 'LayUI\components\LinkPager'
    ];
}