<?php

namespace modules\admin\controllers\setting;

use application\base\AuthController;
use common\models\Setting;
use common\util\Request;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;

class ColumnController extends AuthController
{
    public function actionIndex()
    {
        if (Request::isPost()) {
            $orderList = Request::post("order");
            foreach ($orderList as $id => $newOrder) {
                Setting::updateAll(['order' => intval($newOrder)], ['id' => $id]);
            }
        }

        $groupID = Request::input("group");
        if (empty($groupID)) {
            throw new InvalidParamException("miss param group");
        }

        $condition  = [
            'group_id' => $groupID,
            'display'  => Setting::DISPLAY_COLUMN,
        ];
        $sort       = ['group_id' => SORT_ASC, 'order' => SORT_DESC];
        $columnList = Setting::find()->where($condition)->orderBy($sort)->all();

        return $this->render("index", [
            'columnList' => $columnList,
            'groupId'    => $groupID,
        ]);
    }

    public function actionCreate($id)
    {
        if (!Setting::findOne($id)) {
            throw new NotFoundHttpException("table setting's id:{$id} is not exist");
        }

        $model           = new Setting();
        $model->group_id = $id;

        if (Request::isPost() && $model->load(Request::post()) && $model->createColumn()) {
            $this->redirect(['index', 'group' => $model->group_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Setting::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        if (Request::isPost() && $model->load(Request::post()) && $model->save()) {
            $this->redirect(['index', 'group' => $model->group_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Setting::findOne($id);
        $model->delete();
        $this->redirect(['index', 'group' => $model->group_id]);
    }
}