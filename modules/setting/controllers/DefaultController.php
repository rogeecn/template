<?php

namespace modules\setting\controllers;

use common\util\Request;
use modules\admin\base\AuthController;
use modules\setting\models\Setting;

class DefaultController extends AuthController
{

    public function actionIndex() {
        if (Request::isPost()){
            $formData = Request::post("group");

            foreach ($formData as $groupID=>$keyMapData){
                foreach ($keyMapData as $alias=>$value){
                    Setting::updateAll(['value'=>$value],['group_id'=>$groupID,'alias'=>$alias]);
                }
            }
        }

        $groupList = Setting::getGroupList(true);
        foreach ($groupList as $groupID => $groupItem) {
            $groupList[$groupID] = [
                'name'    => $groupItem,
                'columns' => Setting::getGroupColumnList($groupID),
            ];
        }


//        var_dump($groupList);exit;
        return $this->render('index', ['groupList' => $groupList]);
    }
}