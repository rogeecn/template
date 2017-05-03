<?php

namespace modules\tag\controllers;

use modules\admin\base\AuthController;

class DefaultController extends AuthController
{
    public function actionIndex() {
        return $this->render('index', [
            'tags' => ['a', 'b', 'c'],
        ]);
    }
}
