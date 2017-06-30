<?php
namespace application\controllers;

use application\base\WebController;

class TestController extends WebController
{
    public function actionIndex()
    {
        $this->layout = "test";

        return $this->render("/test");
    }
}
