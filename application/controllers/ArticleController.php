<?php
namespace application\controllers;

use application\base\WebController;

class ArticleController extends WebController
{
    public function actionIndex($id)
    {
        echo $id;
        exit;

        return $this->render("//article");
    }
}
