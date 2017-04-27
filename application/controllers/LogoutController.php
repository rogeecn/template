<?php
namespace application\controllers;


use application\base\WebController;
use common\extend\UserInfo;

class LogoutController extends WebController
{
    public function actionIndex()
    {
        UserInfo::logout();
        return $this->goHome();
    }
}