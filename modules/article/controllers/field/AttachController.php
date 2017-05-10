<?php

namespace modules\article\controllers\field;

use common\util\Request;
use LayUI\components\Html;
use modules\article\models\ArticleField;
use modules\admin\base\AuthController;

class AttachController extends AuthController
{
    public function actionIndex()
    {
        $type = Request::input("type");
        if (empty($type)) {
            return $this->renderFailed(['type' => '参数为空']);
        }

        $allFields  = ArticleField::fieldList();
//        $typeFields = ArticleField::getTypeFieldList($type);

        return $this->render("index", [
            "allFields" => $allFields,
//            "typeFields" => $typeFields,
            "type" => $type,
        ]);
    }

    public function actionBindInfo()
    {
        $type = Request::input("type");
        if (empty($type)) {
            return $this->renderFailed(['type' => '参数为空']);
        }

        $class = Request::input("class");
        if (empty($class)) {
            return $this->renderFailed(['class' => '参数为空']);
        }

        return $this->render("info",ArticleField::getFieldClassInfo($class));
    }
}