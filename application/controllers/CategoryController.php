<?php
namespace application\controllers;

use application\base\WebController;
use common\models\Category;
use yii\web\NotFoundHttpException;

class CategoryController extends WebController
{
    public function actionIndex($alias)
    {
        $model = Category::getByAlias($alias);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        $categoryInfo = $model->toArray();
        $this->getView()->setTitle($categoryInfo['name']);

        $categoryChildren = Category::getCategoryChildren($categoryInfo['id']);

        $view = '/category';
        if (count($categoryChildren) == 0) {
            $view = '/category-list';
        }

        return $this->render($view, [
            'categoryChildren' => $categoryChildren,
            'categoryInfo'     => $categoryInfo,
            'categoryID'       => $categoryInfo['id'],
            'page-type'        => 'category',
        ]);
    }
}
