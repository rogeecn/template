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
        $dataProvider->query->orderBy(['id'=>SORT_DESC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
