<?php
namespace modules\admin\controllers\tag;

use base\RestAuthController;
use common\models\Tag;
use common\util\Request;

class CompleteController extends RestAuthController
{
    public function actionIndex()
    {
        $item = trim(Request::input("term", ""));
        if (empty($item)) {
            return [];
        }

        return Tag::getByKeyword($item);
    }
}
