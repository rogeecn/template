<?php

namespace modules\api\controllers\category;

use application\base\WebController;
use common\extend\Html;
use common\models\Category;

class ListController extends WebController
{
    public function actionIndex()
    {
        $list  = Category::getFlatIndentList();
        $items = [];
        foreach ($list as $id => $name) {
            $items[] = sprintf("%d|%s", $id, $name);
        }

        return Html::ul($items);
    }
}
