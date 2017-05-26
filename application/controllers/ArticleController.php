<?php
namespace application\controllers;

use application\base\WebController;

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

        return $this->render("/article", [
            'page-type' => 'article',
        ]);
    }
}
