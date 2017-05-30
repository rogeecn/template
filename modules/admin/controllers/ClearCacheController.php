<?php

namespace modules\admin\controllers;


use application\base\AuthController;
use common\util\Json;
use common\util\Request;
use yii\helpers\FileHelper;

class ClearCacheController extends AuthController
{
    public function actionIndex()
    {
        $cacheDataDir = \Yii::getAlias("@runtime/data");
        FileHelper::removeDirectory($cacheDataDir);

        if (Request::isAjax()) {
            return Json::success();
        }

        return $this->redirect("/admin");
    }
}
