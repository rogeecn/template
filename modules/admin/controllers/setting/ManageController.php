<?php
namespace modules\admin\controllers\setting;

use application\base\AuthController;
use common\models\Setting;
use common\util\Request;

class ManageController extends AuthController
{

    public function actionIndex()
    {
        if (Request::isPost()) {
            $formData = Request::post("group");

            foreach ($formData as $groupID => $keyMapData) {
                foreach ($keyMapData as $alias => $value) {
                    if (is_array($value)) {
                        $value = implode(",", $value);
                    }
                    Setting::updateAll(['value' => $value], ['group_id' => $groupID, 'alias' => $alias]);

                    $settingCacheFile = \Yii::getAlias("@runtime/data/setting.php");
                    @unlink($settingCacheFile);
                }
            }
        }

        $groupList = Setting::getGroupList(TRUE);
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