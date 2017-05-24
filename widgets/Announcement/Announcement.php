<?php
namespace widgets\Announcement;


use common\base\Field;
use common\base\Widget;
use common\models\Article;
use common\models\Category;
use yii\db\Query;

class Announcement extends Widget
{
    private $title;
    private $category;
    private $content;

    public function init()
    {
        parent::init();

        $newData = (new Query())
            ->limit(1)
            ->where(['checked' => 1])
            ->orderBy(['id' => SORT_DESC])
            ->from("field_announcement_article")
            ->one();

        $articleData  = Article::getDataByID($newData['id'], Field::MODE_SUMMARY);
        $categoryData = Category::getByID($articleData['category_id']);

        $this->title = [
            'label' => $articleData['title'],
            'url'   => ['article/id', 'id' => $articleData['id']],
        ];

        $this->category = [
            'label' => $categoryData['name'],
            'url'   => ['category/index', 'alias' => $categoryData['alias']],
        ];

        $this->content = $articleData['fields']['data']['description'];
    }

    public function run()
    {
        if (empty($this->title)) {
            return "<!--announcement block empty-->";
        }

        return $this->render("view", [
            'title'    => $this->title,
            'category' => $this->category,
            'content'  => $this->content,
        ]);
    }
}