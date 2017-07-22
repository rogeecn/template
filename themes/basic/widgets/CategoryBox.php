<?php
namespace themes\basic\widgets;


use common\base\Widget;
use common\extend\Html;
use common\models\Article;
use common\models\Category;
use yii\base\Exception;

class CategoryBox extends Widget
{
    public $options       = ['class' => 'widget border widget-box'];
    public $categoryAlias = "";
    public $categoryID    = "";
    public $title         = "";

    private $categoryInfo = "";

    public function init()
    {
        if (!empty($this->categoryID)) {
            $this->categoryInfo = Category::getByID($this->categoryID);

            return;
        }

        if (!empty($this->categoryAlias)) {
            $this->categoryInfo = Category::getByAlias($this->categoryAlias);

            return;
        }

        throw new Exception("categoryAlias or categoryID required!");
    }

    public function run()
    {
        if (!$this->categoryInfo) {
            return "";
        }

        $titleName = $this->title;
        if (empty($this->title)) {
            $titleName = $this->categoryInfo['name'];
        }
        $link  = Html::a($titleName, $this->getView()->categoryUrl($this->categoryAlias));
        $title = Html::tag("h2", $link, ['class' => 'title']);


        $categoryID      = $this->categoryInfo['id'];
        $subCategoryList = Category::getSubTree($categoryID);
        $subCategoryId   = $this->getSubCategoryID($subCategoryList);
        $categoryArticle = Article::getListByCategoryID($subCategoryId, 0, 10, false);

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