<?php
namespace modules\admin\controllers;


use application\base\WebController;
use common\extend\UserInfo;
use modules\admin\models\LoginForm;
use common\util\Request;

class LoginController extends WebController
{
    public $layout = "login";

    public function actionIndex()
    {
        if (!UserInfo::isGuest()) {
            return $this->redirect('/admin');
        }

        $model = new LoginForm();
        if ($model->load(Request::post()) && $model->login()) {
            return $this->redirect('/admin');
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}