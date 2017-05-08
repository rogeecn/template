<?php

namespace modules\article\controllers;

use modules\article\models\ArticleSearch;
use common\util\Request;
use modules\admin\base\AuthController;

class ManageController extends AuthController
{
    public function actionIndex() {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Request::get());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
