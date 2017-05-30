<?php

namespace modules\admin\controllers\article\type;

use application\base\AuthController;
use common\models\ArticleType;

class ListController extends AuthController
{
    public function actionIndex()
    {
        $typeList = ArticleType::find()->orderBy(['order' => SORT_ASC])->asArray()->all();

        return $this->render('index', [
            'typeList' => $typeList,
        ]);
    }
}

