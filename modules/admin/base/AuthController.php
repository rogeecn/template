<?php
namespace modules\admin\base;


use application\base\WebController;
use common\extend\UserInfo;

class AuthController extends WebController
{
    public function beforeAction($action)
    {
        if (UserInfo::isGuest()){
            $this->redirect(['/admin/login']);
            return false;
        }

        return parent::beforeAction($action);
    }
}