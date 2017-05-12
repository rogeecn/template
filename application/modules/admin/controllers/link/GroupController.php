<?php
namespace application\modules\admin\controllers\link;

use common\util\Request;
use application\base\AuthController;
use common\models\LinkGroup;
use yii\web\NotFoundHttpException;

class GroupController extends AuthController
{
    public function actionIndex() {
        if (Request::isPost()){
            $orderList = Request::post("order");
            foreach ($orderList as $id=>$newOrder){
                LinkGroup::updateAll(['order'=>intval($newOrder)],['id'=>$id]);
            }
        }
        return $this->render("index", ['groupList' => LinkGroup::getGroupList()]);
    }

    public function actionCreate() {
        $model = new LinkGroup();
        if (Request::isPost() && $model->load(Request::post()) && $model->createGroup()) {
            $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $model = LinkGroup::findOne($id);
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
        $model = LinkGroup::findOne($id);
        LinkGroup::deleteAll(['group_id' => $model->id]);
        $model->delete();
        $this->redirect(['index']);
    }
}