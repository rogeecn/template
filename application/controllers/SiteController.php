<?php
namespace application\controllers;

use application\base\WebController;
use common\models\Category;

class SiteController extends WebController
{
    public function actionIndex() {
        return $this->render("index");
    }

    public function actionRead() {
        return $this->render("read");
    }
}
