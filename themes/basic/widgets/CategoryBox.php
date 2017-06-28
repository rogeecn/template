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

    private $categoryInfo = "";

    public function init()
    {
        if (!empty($this->categoryID)) {
            $this->categoryInfo = Category::getByID($this->categoryID);
        }

        if (!empty($this->categoryAlias)) {
            $this->categoryInfo = Category::getByAlias($this->categoryAlias);
        }

        throw new Exception("categoryAlias or categoryID required!");
    }

    public function run()
    {
        if (!$this->categoryInfo) {
            return "";
        }

        $link  = Html::a($this->categoryInfo['name'], $this->getView()->categoryUrl($this->categoryAlias));
        $title = Html::tag("h2", $link, ['class' => 'title']);


        $categoryArticle = Article::getListByCategoryID($this->categoryInfo['id'], 0, 10, FALSE);

        $itemList = [];
        foreach ($categoryArticle as $item) {
            $time         = Html::tag("time", date("Y-m-d", $item['created_at']));
            $articleTitle = Html::a($item['title'], $this->getView()->articleIDURL($item['id']), ['target' => "_blank"]);

            $itemList[] = $time . $articleTitle;
        }
        $body = Html::ul($itemList, ['class' => 'body item-list', 'encode' => FALSE]);

        return Html::div($title . $body, $this->options);
    }
}