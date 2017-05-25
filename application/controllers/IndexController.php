<?php
namespace application\controllers;

use application\base\WebController;
use common\util\Request;

class IndexController extends WebController
{
    public function actionIndex()
    {
        if (!empty(Request::pathInfo())) {
            return $this->redirect("/", 301);
        }

        return $this->render("/index");
    }
}
