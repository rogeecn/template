<?php

namespace modules\uploader\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->renderAjax('index');
    }
}
