<?php
namespace application\controllers;

use application\base\WebController;
use common\extend\UserInfo;

class SiteController extends  WebController
{
    public function actionIndex()
    {
        if (UserInfo::isGuest()){
            return $this->redirect("/login");
        }
        return $this->redirect("/dashboard");
    }

    public function actionHello()
    {
        return $this->renderAjax("hello");
    }
}
