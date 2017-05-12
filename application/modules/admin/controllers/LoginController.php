<?php
namespace application\modules\admin\controllers;


use application\base\WebController;
use common\extend\UserInfo;
use common\models\AdminLoginForm;
use common\util\Request;

class LoginController extends WebController
{
    public $layout = "login";

    public function actionIndex() {
        if (!UserInfo::isGuest()) {
            return $this->redirect('/admin');
        }

        $model = new AdminLoginForm();
        if ($model->load(Request::post()) && $model->login()) {
            return $this->redirect('/admin');
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}