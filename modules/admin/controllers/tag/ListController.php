<?php
namespace modules\admin\controllers\tag;

use application\base\AuthController;
use common\models\TagSearch;
use common\util\Request;

class ListController extends AuthController
{
    public function actionIndex()
    {
        $searchModel  = new TagSearch();
        $dataProvider = $searchModel->search(Request::input());

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
