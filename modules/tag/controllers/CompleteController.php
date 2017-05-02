<?php

namespace modules\tag\controllers;

use common\util\Request;
use modules\admin\base\RestAuthController;
use modules\tag\models\Tag;

class CompleteController extends RestAuthController
{
    public function actionIndex()
    {
        $item = trim(Request::input("term",""));
        if (empty($item)){
            return [];
        }

        return Tag::getByKeyword($item);
    }
}
