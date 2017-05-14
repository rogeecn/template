<?php
namespace modules\admin\controllers\tag;

use common\util\Request;
use base\AuthController;
use common\models\TagSearch;

class ListController extends AuthController
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
