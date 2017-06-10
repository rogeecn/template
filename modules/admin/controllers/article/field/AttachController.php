<?php

namespace modules\admin\controllers\article\field;

use application\base\AuthController;
use common\models\ArticleField;
use common\util\Request;

class AttachController extends AuthController
{
    public function actionIndex()
    {
        $type = Request::input("type");
        if (empty($type)) {
            return $this->renderFailed(['type' => '参数为空']);
        }
        $allFields = ArticleField::fieldList();

        return $this->render("index", [
            "allFields" => $allFields,
            "type"      => $type,
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

        return $this->render("info", ArticleField::getFieldClassInfo($class));
    }
}