<?php
namespace application\controllers;

use application\base\WebController;
use yii\helpers\Url;

class ArticleController extends WebController
{
    public function actionId($id)
    {
        echo $id;exit;
        return $this->getData($id);
    }

    public function actionAlias($alias)
    {
        echo Url::to(['/article/alias','alias'=>'testgogogo']);exit;
        return $this->actionId("10");
    }

    private function getData($id)
    {
        return $this->render("/article");
    }
}
