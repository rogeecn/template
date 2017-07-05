<?php
namespace themes\basic\data;


use common\util\DataProvider;
use common\util\IDataProvider;

class ContentSummary extends DataProvider implements IDataProvider
{
    public function getData()
    {
        return [
            'title'       => "DataProvider Title,",
            'description' => "DataProvider Title,",
            'publish_at'  => "publish_at | ",
            'view_cnt'    => "100 | ",
            'comment_cnt' => "20 | ",
            'author'      => "Rogee | ",
        ];
    }
}