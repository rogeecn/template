<?php
namespace modules\admin\controllers\member;

use application\base\AuthController;
use common\models\UserSearch;

class ListController extends AuthController
{
    public function actionIndex()
    {
        $searchModel  = new UserSearch();
        $params       = \Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
