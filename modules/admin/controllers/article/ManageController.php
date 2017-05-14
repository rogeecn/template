<?php

namespace modules\admin\controllers\article;

use common\models\ArticleSearch;
use common\util\Request;
use base\AuthController;

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
