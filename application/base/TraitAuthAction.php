<?php
namespace application\base;


use common\extend\UserInfo;

trait TraitAuthAction
{

    public function beforeAction($action) {
        if (UserInfo::isGuest()) {
            $this->redirect(['/admin/login']);
            return false;
        }

        return parent::beforeAction($action);
    }
}