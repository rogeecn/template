<?php

namespace modules\setting\controllers;

use common\util\Request;
use modules\admin\base\AuthController;
use modules\setting\models\Setting;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class GroupController extends AuthController
{
    public function actionIndex()
    {
        return $this->render("index",['groupList'=>Setting::getGroupList()]);
    }

    public function actionCreate()
    {
        $model = new Setting();
        if (Request::isPost()&&$model->load(Request::post())&&$model->createGroup()){
            $this->redirect(['index']);
        }
        return $this->render('create',[
            'model'=>$model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Setting::findOne($id);
        if (!$model){
            throw new NotFoundHttpException();
        }
        if (Request::isPost()&&$model->load(Request::post())&&$model->save()){
            $this->redirect(['index']);
        }
        return $this->render('update',[
            'model'=>$model
        ]);
    }

    public function actionDelete($id)
    {
        $model = Setting::findOne($id);
        Setting::deleteAll(['group_id'=>$model->id]);
        $model->delete();
        $this->redirect(['index']);
    }
}