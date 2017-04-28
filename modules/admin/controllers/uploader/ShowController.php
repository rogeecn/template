<?php

namespace modules\admin\controllers\uploader;


use modules\admin\base\AuthController;

class ShowController extends AuthController
{
    public function actionIndex()
    {
        return $this->render("index");
    }
}