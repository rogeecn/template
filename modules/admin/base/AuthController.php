<?php
namespace modules\admin\base;


use application\base\WebController;
use common\extend\UserInfo;

class AuthController extends WebController
{
    use TraitAuthAction;

    public $layout = '@modules/admin/views/layouts/main';

}