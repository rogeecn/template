<?php
namespace themes\basic\widgets\Content;


use common\base\Widget;
use common\models\Article;
use common\models\Category;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class Content extends Widget
{
    public  $articleID   = "";
    private $title       = "";
    private $meta        = [];
    private $content     = [];
    private $url         = [];
    private $description = "";

    public function init()
    {
        parent::init();

        $articleData = self::getCache('article_' . $this->articleID);
        if (!$articleData) {
            $articleData = Article::getDataByID($this->articleID);
            if (!$articleData) {
                throw new NotFoundHttpException();
            }
        }
        self::setCache("article_" . $this->articleID, $articleData);

        $this->title       = $articleData['title'];
        $this->content     = $articleData['fields']['data']['content'];
        $this->description = $articleData['fields']['data']['description'];
        $this->url         = Url::to(['article/id', 'id' => $this->articleID]);

        $categoryData = Category::getByID($articleData['category_id']);

        $this->meta = [
            'time'         => date("y/m/d", $articleData['created_at']),
            'commentCount' => 0,
            'viewCount'    => 0,
            'category'     => [
                'label' => $categoryData['name'],
                'url'   => ['category/index', 'alias' => $categoryData['alias']],
            ],
        ];
    }

    public function run()
    {
        return $this->render("view", [
            'articleID'   => $this->articleID,
            'title'       => $this->title,
            'url'         => $this->url,
            'meta'        => $this->meta,
            'content'     => $this->content,
            'description' => $this->description,
        ]);
    }
}