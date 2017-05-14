<?php

namespace modules\admin\controllers\article\type;

use common\models\ArticleField;
use common\models\ArticleType;
use base\AuthController;

class ListController extends AuthController
{
    public function actionIndex() {
        $typeList = ArticleType::find()->orderBy(['order'=>SORT_ASC])->asArray()->all();
        return $this->render('index', [
            'typeList' => $typeList,
        ]);
    }
}

