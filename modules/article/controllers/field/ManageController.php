<?php

namespace modules\article\controllers\field;

use common\util\Request;
use LayUI\components\ActiveField;
use LayUI\components\Html;
use modules\article\models\ArticleField;
use modules\admin\base\AuthController;

class ManageController extends AuthController
{
    public function actionIndex()
    {
        $type = Request::input("type");
        if (empty($type)) {
            return $this->renderFailed(['type' => '参数为空']);
        }

        $allFields  = ArticleField::fieldList();
        $typeFields = ArticleField::getTypeFieldList($type);

        return $this->render("index", [
            "allFields" => $allFields,
            "typeFields" => $typeFields,
            "type" => $type,
        ]);
    }

    public function actionCreate()
    {
        $type  = Request::input("type");
        $class = Request::input("class");
        if (empty($type) || empty($class)) {
            return $this->renderFailed(['type, class' => '字段为必需字段']);
        }

        $info = ArticleField::getFieldClassInfo($class);

        $model = new ArticleField();
        $model->setAttributes([
            'name' => $info['name'],
            'class' => $class,
            'description' => $info['description'],
            'type_id' => $type,
            'label' => "label",
            'options' => json_encode([]),
        ]);

        if ($model->save()) {
            return $this->renderSuccess(sprintf("字段 [%s] 添加成功", $info['name']), [
                Html::linkButton("继续添加", ['index', 'type' => $type]),
            ]);
        }

        return $this->renderSuccess($model->getErrors());
    }

    public function actionDelete($id)
    {
        $model   = ArticleField::findOne($id);
        $type_id = $model->type_id;
        $model->delete();
        return $this->renderSuccess(null, [
            Html::linkButton("继续操作", ['index', 'type' => $type_id]),
        ]);
    }
}