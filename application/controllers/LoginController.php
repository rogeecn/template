<?php
namespace application\controllers;


use application\base\WebController;
use common\extend\UserInfo;
use common\models\LoginForm;
use common\util\Request;

class LoginController extends WebController
{
    public $layout = "login";

    public function actionIndex()
    {
        if (!UserInfo::isGuest()) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Request::post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}