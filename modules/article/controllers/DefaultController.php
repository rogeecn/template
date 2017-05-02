<?php

namespace modules\article\controllers;

use modules\admin\base\AuthController;
use yii\web\Controller;

/**
 * Default controller for the `article` module
 */
class DefaultController extends AuthController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
