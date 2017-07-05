<?php
namespace application\widgets;


use common\base\Widget;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;

class ContentData extends Widget
{
    public $template = "<ul class='content-summary'><li>{items}</li>{pagination}</ul>";
    public $items;
    public $pagination;

    public function run()
    {
        $itemHtml = implode("\n", $this->items);

        $currentRoute = \Yii::$app->controller->getRoute();
        if (substr($currentRoute, -6) == "/index") {
            $currentRoute = substr($currentRoute, 0, -6);
        } else {
            $currentRoute = FALSE;
        }

        $pagination                  = new Pagination();
        $pagination->pageSizeLimit   = FALSE;
        $pagination->route           = $currentRoute;
        $pagination->pageParam       = ArrayHelper::getValue($this->pagination, "pageParam", 'p');
        $pagination->totalCount      = ArrayHelper::getValue($this->pagination, "totalCount", 0);
        $pagination->defaultPageSize = ArrayHelper::getValue($this->pagination, "pageSize", 5);

        $linkPager = LinkPager::widget([
            'prevPageLabel' => ArrayHelper::getValue($this->pagination, "prevPageLabel", '上一页'),
            'nextPageLabel' => ArrayHelper::getValue($this->pagination, "nextPageLabel", '下一页'),
            'pagination'    => $pagination,
        ]);

        return strtr($this->template, [
            "{items}"      => $itemHtml,
            "{pagination}" => $linkPager,
        ]);
    }
}