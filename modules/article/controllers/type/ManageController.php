<?php

namespace modules\article\controllers\type;

use common\util\Request;
use modules\admin\base\AuthController;
use modules\article\models\ArticleType;
use modules\article\models\ArticleTypeSearch;
use yii\web\NotFoundHttpException;

class ManageController extends AuthController
{
    public function actionIndex() {
        if (Request::isPost()) {
            $orderList = Request::input("order");
            foreach ($orderList as $id => $newOrder) {
                ArticleType::updateAll(['order' => $newOrder], ['id' => $id]);
            }
        }

        $searchModel  = new ArticleTypeSearch();
        $dataProvider = $searchModel->search(Request::queryParams());
        $dataProvider->query->orderBy(['order' => SORT_ASC]);
        $dataProvider->pagination->pageSize = 1000000;

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate() {
        $model = new ArticleType();

        if (Request::isPost() && $model->load(Request::post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render("create", [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $model = ArticleType::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        if (Request::isPost() && $model->load(Request::post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render("create", [
            'model' => $model,
        ]);
    }
}
