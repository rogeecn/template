<?php
namespace modules\admin\controllers;


use common\extend\UserInfo;
use modules\admin\base\AuthController;

class LogoutController extends AuthController
{
    public function actionIndex() {
        UserInfo::logout();
        return $this->goHome();
    }
}