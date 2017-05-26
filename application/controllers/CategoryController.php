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
        $categoryInfo     = $model->toArray();
        $categoryChildren = Category::getCategoryChildren($categoryInfo['id']);

        return $this->render("/category", [
            'categoryChildren' => $categoryChildren,
            'categoryInfo'     => $categoryInfo,
            'categoryID'       => $categoryInfo['id'],
            'page-type'        => 'category',
        ]);
    }
}
