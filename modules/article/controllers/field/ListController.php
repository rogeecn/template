<?php

namespace modules\article\controllers\field;

use modules\article\models\ArticleField;
use modules\admin\base\AuthController;

class ListController extends AuthController
{
    public function actionIndex() {
        var_dump(ArticleField::fieldList());
    }
}