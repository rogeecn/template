<?php

namespace modules\admin\controllers;


use application\base\AuthController;

class DefaultController extends AuthController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
