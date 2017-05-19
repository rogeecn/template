<?php
namespace modules\admin\controllers\category;

use application\base\AuthController;
use common\models\Category;
use common\util\Request;

class ControlController extends AuthController
{
    public function actionCreate($id)
    {
        $model = new Category();
        if (Request::isPost() && $model->load(Request::post()) && $model->save()) {
            return $this->redirect("/admin/category/list");
        }
        $model->pid = $id;

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Category::findOne($id);
        if (Request::isPost() && $model->load(Request::post()) && $model->save()) {
            return $this->redirect("/admin/category/list");
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $deleteItemTree = Category::getSubTree($id, TRUE);
        if (count($deleteItemTree)) {
            Category::deleteAll(['id' => array_keys($deleteItemTree)]);
        }

        return $this->redirect("/admin/category/list");
    }
}
