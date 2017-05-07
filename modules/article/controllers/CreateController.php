<?php

namespace modules\article\controllers;

use modules\admin\base\AuthController;
use modules\article\models\Article;

class CreateController extends AuthController
{
    public function actionIndex() {
        $model = new Article();
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
