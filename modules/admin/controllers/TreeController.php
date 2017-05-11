<?php

namespace modules\admin\controllers;

use application\base\RestController;
use modules\setting\models\Setting;
use yii\helpers\Url;

class TreeController extends RestController
{
    public function actionIndex() {
        return Setting::flatSettings();
    }
}
