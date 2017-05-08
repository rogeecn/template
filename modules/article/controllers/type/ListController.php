<?php

namespace modules\article\controllers\type;

use modules\admin\base\AuthController;
use modules\article\models\ArticleType;

class ListController extends AuthController
{
    public function actionIndex() {
        $typeList = ArticleType::find()->orderBy(['order'=>SORT_ASC])->asArray()->all();
        return $this->render('index', [
            'typeList' => $typeList,
        ]);
    }
}

