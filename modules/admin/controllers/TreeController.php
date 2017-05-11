<?php

namespace modules\admin\controllers;

use application\base\RestController;
use modules\admin\base\AuthController;
use modules\setting\models\Setting;
use yii\helpers\Url;

//class TreeController extends RestController
class TreeController extends AuthController
{
    public function actionIndex() {
        $this->view->theme->setTheme("basic");
        return $this->render("index");
//        return Setting::flatSettings();
    }
}
