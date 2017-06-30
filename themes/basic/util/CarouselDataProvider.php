<?php
namespace themes\basic\util;

use common\extend\Html;
use common\models\Article;
use common\util\DataProvider;
use common\util\IDataProvider;

class CarouselDataProvider extends DataProvider implements IDataProvider
{
    public $articleType = 'carousel';
    public $offset      = 0;
    public $count       = 3;

    public function getData()
    {
        // article data
        $dataList = Article::getListByTypeAlias($this->articleType, $this->offset, $this->count);

        $items = [];
        foreach ($dataList as $item) {
            $items[] = [
                'label'       => $item['title'],
                'description' => $item['fields']['carousel']['description'],
                'content'     => Html::img($item['fields']['image']['image']),
                'url'         => $item['fields']['carousel']['link'],
            ];
        }


        return $items;
    }
}