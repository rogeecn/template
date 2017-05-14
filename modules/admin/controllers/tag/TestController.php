<?php
namespace modules\admin\controllers\tag;

use base\AuthController;

class TestController extends AuthController
{
    public function actionIndex() {
        return $this->render("tag", [
            'tags' => ['a', 'b', 'c'],
        ]);
    }
}
