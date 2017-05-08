<?php

namespace modules\article\controllers;

use common\util\Request;
use modules\admin\base\AuthController;
use modules\article\models\Article;

class CreateController extends AuthController
{
    public function actionIndex() {
        $model = new Article();
        $model->type = Request::input("type");

        if (Request::isPost() && $model->load(Request::post())&&$model->save()){
            return $this->redirect("/article/manage");
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
