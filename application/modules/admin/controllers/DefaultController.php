<?php

namespace application\modules\admin\controllers;


use application\base\AuthController;

class DefaultController extends AuthController
{
    public function actionIndex() {
        $this->layout = "dashboard";
        return $this->render('index');
    }
}