<?php
namespace application\base;


class AuthController extends WebController
{
    use TraitAuthAction;

    public $layout = '@modules/admin/views/layouts/main';

    public function renderSuccess($msg = null, $buttons = []) {
        if (empty($msg)) {
            $msg = "恭喜您，操作成功";
        }
        return $this->render("@modules/admin/views/common/success", [
            'buttons' => $buttons,
            'msg'     => $msg,
        ]);
    }

    public function renderFailed($reasons = []) {
        if (is_string($reasons)) {
            $reasons = ["Err: " => $reasons];
        }
        return $this->render("@modules/admin/views/common/fail", [
            'reasons' => $reasons,
        ]);
    }
}