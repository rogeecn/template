<?php

namespace application\modules\dashboard\controllers;

use application\base\AuthController;

class DefaultController extends AuthController
{
    public function actionIndex()
    {
        $this->layout = "main";
        return $this->render('index');
    }
}
