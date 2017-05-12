<?php

namespace modules\fex\controllers;

use application\base\AuthController;

/**
 * Default controller for the `fex` module
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
