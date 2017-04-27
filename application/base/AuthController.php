<?php
namespace application\base;


use common\extend\UserInfo;

class AuthController extends WebController
{
    public function beforeAction($action)
    {
        if (UserInfo::isGuest()){
            $this->goHome();
            return false;
        }

        return parent::beforeAction($action);
    }
}