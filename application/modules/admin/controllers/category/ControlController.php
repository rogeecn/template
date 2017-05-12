<?php
namespace application\modules\admin\controllers\category;

use common\util\Request;
use application\base\AuthController;
use common\models\Category;

class ControlController extends AuthController
{
    public function actionCreate() {
        $model = new Category();
        if (Request::isPost() && $model->load(Request::post()) && $model->save()) {
            return $this->redirect("/category");
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $model = Category::findOne($id);
        if (Request::isPost() && $model->load(Request::post()) && $model->save()) {
            return $this->redirect("/category");
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
