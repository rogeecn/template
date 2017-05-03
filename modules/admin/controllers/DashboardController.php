<?php
namespace modules\admin\controllers;


use modules\admin\base\AuthController;

class DashboardController extends AuthController
{
    public function actionIndex() {
        return $this->render("index");
    }
}