<?php

namespace modules\article\controllers;

use common\util\Request;
use LayUI\components\Html;
use modules\admin\base\AuthController;
use modules\article\models\Article;

class CreateController extends AuthController
{
    public function actionIndex() {
        $model = new Article();
        $model->type = Request::input("type");

        if (Request::isPost() && $model->load(Request::post())&&$model->save()){
            return $this->renderSuccess(null,[
                Html::linkButton("继续添加",['/article/create','type'=>$model->type]),
            ]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
