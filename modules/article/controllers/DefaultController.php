<?php

namespace modules\article\controllers;

use modules\article\models\ArticleSearch;
use common\util\Request;
use modules\admin\base\AuthController;

class DefaultController extends AuthController
{
    public function actionIndex() {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Request::input());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
