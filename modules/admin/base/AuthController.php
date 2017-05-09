<?php
namespace modules\admin\base;


use application\base\WebController;

class AuthController extends WebController
{
    use TraitAuthAction;

    public $layout = '@modules/admin/views/layouts/main';

    public function renderSuccess($msg = null,$buttons = [])
    {
        if (empty($msg)){
            $msg = "恭喜您，操作成功";
        }
        return $this->render("@modules/admin/views/common/success",[
            'buttons'=>$buttons,
            'msg'=>$msg,
        ]);
    }

    public function renderFailed($reasons = [])
    {
        return $this->render("@modules/admin/views/common/fail",[
            'reasons'=>$reasons,
        ]);
    }
}