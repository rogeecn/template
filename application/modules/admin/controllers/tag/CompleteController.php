<?php
namespace application\modules\admin\controllers\tag;

use common\util\Request;
use application\base\RestAuthController;
use common\models\Tag;

class CompleteController extends RestAuthController
{
    public function actionIndex() {
        $item = trim(Request::input("term", ""));
        if (empty($item)) {
            return [];
        }

        return Tag::getByKeyword($item);
    }
}