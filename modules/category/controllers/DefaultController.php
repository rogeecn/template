<?php

namespace modules\category\controllers;

use common\util\Request;
use modules\admin\base\AuthController;
use modules\category\models\Category;

class DefaultController extends AuthController
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
