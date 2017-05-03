<?php
namespace modules\admin\base;


use application\base\WebController;

class AuthController extends WebController
{
    use TraitAuthAction;

    public $layout = '@modules/admin/views/layouts/main';

}