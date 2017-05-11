<?php
/**
 * Created by PhpStorm.
 * User: rogee
 * Date: 2017/5/11
 * Time: 23:11
 */

namespace application\modules\test\controllers;


use application\base\WebController;

class DefaultController extends WebController
{

    public function actionIndex() {
        return $this->render('index');
    }
}