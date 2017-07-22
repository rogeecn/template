<?php
namespace themes\basic\widgets;


use common\base\Widget;
use common\extend\Html;
use common\models\Article;

class LatestArticles extends Widget
{
    public $options = ['class' => 'widget border widget-box'];
    public $count   = 20;
    public $title   = "最新发布";

    public function run()
    {
        $titleName = $this->title;
        if (empty($this->title)) {
            $titleName = $this->categoryInfo['name'];
        }
        $link  = Html::a($titleName, "#");
        $title = Html::tag("h2", $link, ['class' => 'title']);

        $categoryArticle = Article::getListByCategoryID(null, 0, $this->count, false);

        $itemList = [];
        foreach ($categoryArticle as $item) {
            $time         = Html::tag("time", date("Y-m-d", $item['created_at']));
            $articleTitle = Html::a($item['title'], $this->getView()->articleIDURL($item['id']), ['target' => "_blank"]);

            $itemList[] = $time . $articleTitle;
        }
        $body = Html::ul($itemList, ['class' => 'body item-list', 'encode' => false]);

        return Html::div($title . $body, $this->options);
    }

    private function getSubCategoryID($categoryList)
    {
        $idList = [$categoryList['id']];
        if (isset($categoryList['children'])) {
            foreach ($categoryList['children'] as $item) {
                if (isset($item['children'])) {
                    $idList = array_merge($idList, $this->getSubCategoryID($item['children']));
                    continue;
                }

                $idList[] = $item['id'];
            }
        }

        return $idList;
    }
}