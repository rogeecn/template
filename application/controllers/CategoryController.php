<?php
namespace application\controllers;

use application\base\WebController;
use common\models\Category;
use common\util\Request;
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

        var_dump($categoryInfo);
        exit;

        return $this->render("category");
    }
}
