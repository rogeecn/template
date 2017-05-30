<?php
namespace modules\admin\controllers;


use application\base\AuthController;
use common\extend\UserInfo;

class LogoutController extends AuthController
{
    public function actionIndex()
    {
        UserInfo::logout();

        return $this->goHome();
    }
}