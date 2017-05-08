<?php

namespace modules\article\controllers\type;

use common\util\Request;
use modules\admin\base\AuthController;
use modules\article\models\ArticleType;
use modules\article\models\ArticleTypeSearch;

class ManageController extends AuthController
{
    public function actionIndex() {
        $searchModel  = new ArticleTypeSearch();
        $dataProvider = $searchModel->search(Request::queryParams());

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate() {
        $model = new ArticleType();

        if (Request::isPost() && $model->load(Request::post())&&$model->save()){
            return $this->redirect(['index']);
        }

        return $this->render("create",[
            'model'=>$model
        ]);
    }
}
