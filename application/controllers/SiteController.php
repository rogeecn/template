<?php
namespace application\controllers;

use application\base\WebController;
use common\extend\UserInfo;

class SiteController extends WebController
{
    public function actionIndex() {
        return $this->render("index");
    }
}
