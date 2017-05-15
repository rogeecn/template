<?php

namespace modules\admin\controllers\article\field;

use application\base\AuthController;
use common\models\ArticleField;
use common\util\Request;
use plugins\LayUI\components\Html;

class ManageController extends AuthController
{
    public function actionIndex() {
        $type = Request::input("type");
        if (empty($type)) {
            return $this->renderFailed(['type' => '参数为空']);
        }

        if (Request::isPost()) {
            $orderList = Request::input("order");

            foreach ($orderList as $id => $newOrder) {
                ArticleField::updateAll(['order' => $newOrder], ['id' => $id]);
            }
        }

        $allFields  = ArticleField::fieldList();
        $typeFields = ArticleField::getTypeFieldList($type);

        return $this->render("index", [
            "allFields"  => $allFields,
            "typeFields" => $typeFields,
            "type"       => $type,
        ]);
    }

    public function actionCreate() {
        if (!Request::isPost() || empty(Request::input("info"))) {
            return $this->renderFailed(["info" => '信息为空']);
        }

        $info  = Request::input("info");
        if (!isset($info['options'])){
            $info['options'] = [];
        }

        $model = new ArticleField();
        $model->setAttributes([
            'name'        => $info['name'],
            'table'       => $info['table'],
            'class'       => $info['class'],
            'description' => $info['description'],
            'type_id'     => $info['type'],
            'label'       => $info['label'],
            'options'     => json_encode($info['options']),
        ]);

        if ($model->save()) {
            return $this->renderSuccess(sprintf("字段 [%s] 添加成功", $model->name), [
                Html::linkButton("继续添加", ['/admin/article/field/manage', 'type' => $info['type']]),
            ]);
        }

        return $this->renderFailed($model->getFlatErrors());
    }

    public function actionUpdate($id) {
        $model = ArticleField::findOne($id);
        if (Request::isPost()) {
            $info = Request::input("info");

            if (!isset($info['options'])){
                $info['options'] = [];
            }

            $model->setAttributes([
                'name'        => $info['name'],
                'table'       => $info['table'],
                'description' => $info['description'],
                'label'       => $info['label'],
                'options'     => json_encode($info['options']),
            ]);

            if ($model->save()) {
                return $this->renderSuccess(sprintf("字段 [%s] 编辑成功", $info['name']), [
                    Html::linkButton("继续修改", ['/admin/article/field/manage/update', 'id' => $id]),
                ]);
            }
        }


        return $this->render('update', [
            'fieldData'   => $model->toArray(),
            'fieldConfig' => ArticleField::getFieldClassInfo($model->class),
        ]);
    }

    public function actionDelete($id) {
        $model   = ArticleField::findOne($id);
        $type_id = $model->type_id;
        $model->delete();
        return $this->renderSuccess(null, [
            Html::linkButton("继续操作", ['index', 'type' => $type_id]),
        ]);
    }
}