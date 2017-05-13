<?php
namespace application\modules\admin\controllers\tag;

use application\base\AuthController;

class TestController extends AuthController
{
    public function actionIndex() {
        return $this->render("tag", [
            'tags' => ['a', 'b', 'c'],
        ]);
    }
}
