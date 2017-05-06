<?php

namespace modules\tag\controllers;

use common\util\Request;
use modules\admin\base\AuthController;
use modules\tag\models\TagSearch;

class DefaultController extends AuthController
{
    public function actionIndex() {
        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search(Request::input());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
