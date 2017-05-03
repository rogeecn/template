<?php

namespace modules\setting\controllers;

use common\util\Request;
use modules\admin\base\AuthController;
use modules\setting\models\Setting;
use yii\web\NotFoundHttpException;

class ColumnController extends AuthController
{
    public function actionIndex() {
        $columnList = Setting::find()->where(['display' => Setting::DISPLAY_COLUMN])->all();
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