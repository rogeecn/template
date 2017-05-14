<?php

namespace modules\admin\controllers;


use base\AuthController;

class DefaultController extends AuthController
{
    public function actionIndex() {
        $this->layout = "dashboard";
        return $this->render('index');
    }
}
