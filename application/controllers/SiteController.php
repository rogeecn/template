<?php
namespace application\controllers;

use application\base\WebController;

class SiteController extends WebController
{
    public function actionIndex() {
//        $this->view->theme->setTheme("basic");
        return $this->render("index");
    }
}
