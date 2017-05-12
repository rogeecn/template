<?php

namespace application\modules\admin\controllers\setting;

use common\util\Request;
use application\base\AuthController;
use common\models\Setting;
use yii\web\NotFoundHttpException;

class ColumnController extends AuthController
{
    public function actionIndex() {
        if (Request::isPost()){
            $orderList = Request::post("order");
            foreach ($orderList as $id=>$newOrder){
                Setting::updateAll(['order'=>intval($newOrder)],['id'=>$id]);
            }
        }
        $columnList = Setting::find()->where(['display' => Setting::DISPLAY_COLUMN])->orderBy(['group_id'=>SORT_ASC,'order'=>SORT_DESC])->all();
        return $this->render("index", ['columnList' => $columnList]);
    }

    public function actionCreate() {
        $model = new Setting();
        if (Request::isPost() && $model->load(Request::post()) && $model->createColumn()) {
            $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $model = Setting::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        if (Request::isPost() && $model->load(Request::post()) && $model->save()) {
            $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $model = Setting::findOne($id);
        Setting::deleteAll(['group_id' => $model->id]);
        $model->delete();
        $this->redirect(['index']);
    }
}