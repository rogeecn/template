<?php

namespace modules\setting\controllers;

use modules\admin\base\AuthController;
use modules\setting\models\Setting;

class DefaultController extends AuthController
{

    public function actionIndex() {
        $groupList = Setting::getGroupList(true);
        foreach ($groupList as $groupID => &$groupItem) {
            $groupItem = [
                'name'    => $groupItem,
                'columns' => Setting::getGroupColumnList($groupID),
            ];
        }

        return $this->render('index', ['groupList' => $groupList]);
    }
}