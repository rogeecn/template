<?php

namespace modules\tag\controllers;

use modules\admin\base\RestAuthController;

class CompleteController extends RestAuthController
{
    public function actionIndex()
    {
        return ['aaa','bbb','ccc'];
    }
}
