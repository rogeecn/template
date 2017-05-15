<?php

namespace application\modules\article\controllers;

use application\base\WebController;

class IndexController extends WebController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
