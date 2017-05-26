<?php
namespace application\controllers;

use application\base\WebController;
use common\base\Widget;
use common\models\Article;
use common\models\Category;
use yii\web\NotFoundHttpException;

class ArticleController extends WebController
{
    public function actionAlias($alias)
    {
        return $this->actionId(10);
    }

    public function actionId($id)
    {
        return $this->getData($id);
    }

    private function getData($id)
    {
        $articleInfo = Article::findOne($id);
        if (!$articleInfo) {
            throw new NotFoundHttpException();
        }
        Widget::setCache("article_info_" . $id, $articleInfo);
        $categoryInfo = Category::findOne($articleInfo['category_id']);

        return $this->render("/article", [
            'articleInfo'  => $articleInfo,
            'categoryInfo' => $categoryInfo,
            'categoryID'   => $categoryInfo['id'],
            'page-type'    => 'article',
        ]);
    }
}
