<?php
namespace modules\admin\controllers\setting;

use common\util\Request;
use application\base\AuthController;
use common\models\Setting;

class ManageController extends AuthController
{

    public function actionIndex() {
        if (Request::isPost()){
            $formData = Request::post("group");

            foreach ($formData as $groupID=>$keyMapData){
                foreach ($keyMapData as $alias=>$value){
                    if (is_array($value)){
                        $value=implode(",",$value);
                    }
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