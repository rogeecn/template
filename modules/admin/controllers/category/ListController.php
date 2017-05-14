<?php

namespace modules\admin\controllers\category;

use common\util\Request;
use base\AuthController;
use common\models\Category;

class ListController extends AuthController
{
    public function actionIndex()
    {
        if (Request::isPost()){
            $orderList = Request::post("order");
            foreach ($orderList as $id=>$newOrder){
                Category::updateAll(['order'=>intval($newOrder)],['id'=>$id]);
            }
        }

        return $this->render('index',[
            'dataList'=>Category::getList()
        ]);
    }
}
