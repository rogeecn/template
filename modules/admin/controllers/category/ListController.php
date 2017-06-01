<?php

namespace modules\admin\controllers\category;

use application\base\AuthController;
use common\models\Category;
use common\util\Request;

class ListController extends AuthController
{
    public function actionIndex()
    {
        if (Request::isPost()) {
            $orderList = Request::post("order");
            foreach ($orderList as $id => $newOrder) {
                Category::updatePath();
                Category::updateAll(['order' => intval($newOrder)], ['id' => $id]);
            }
        }

        $sortList = Category::getFlatIndentList();
        $dataList = Category::getList();

        $sortDataList = [];
        foreach ($sortList as $id => $value) {
            $data           = $dataList[$id];
            $data['name']   = $value;
            $sortDataList[] = $data;
        }

        return $this->render('index', [
            'dataList' => $sortDataList,
        ]);
    }
}
