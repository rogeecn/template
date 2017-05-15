<?php
namespace application\controllers;

use application\base\WebController;

class SiteController extends WebController
{
    public function actionIndex() {
        return $this->render("index");
    }

    public function actionTest()
    {
        return $this->render("test");
    }
}
