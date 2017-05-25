<?php

namespace modules\admin\controllers\link;

use application\base\AuthController;
use common\models\Category;
use common\models\LinkGroup;
use common\util\Request;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;

class ItemController extends AuthController
{
    public function actionIndex()
    {
        if (Request::isPost()) {
            $orderList = Request::post("order");
            foreach ($orderList as $id => $newOrder) {
                LinkGroup::updateAll(['order' => intval($newOrder)], ['id' => $id]);
            }
        }

        $groupID = Request::input("group");
        if (empty($groupID)) {
            throw new InvalidParamException("miss param group");
        }

        $condition = [
            'group_id' => $groupID,
            'display'  => LinkGroup::DISPLAY_LINK,
        ];
        $sort      = ['group_id' => SORT_ASC, 'order' => SORT_ASC];
        $linkList  = LinkGroup::find()->where($condition)->orderBy($sort)->all();

        foreach ($linkList as &$linkItem) {
            if ($linkItem['type'] == LinkGroup::TYPE_CATEGORY) {
                $categoryModel = Category::findOne($linkItem['value']);
                if (!$categoryModel) {
                    continue;
                }
                $linkItem['title'] = $categoryModel->name;
                $linkItem['alias'] = $categoryModel->alias;
            }
        }

        return $this->render("index", [
            'linkList' => $linkList,
            'groupId'  => $groupID,
        ]);
    }

    public function actionCreate($id)
    {
        if (!LinkGroup::findOne($id)) {
            throw new NotFoundHttpException("table setting's id:{$id} is not exist");
        }

        $model           = new LinkGroup();
        $model->group_id = $id;

        if (Request::isPost() && $model->load(Request::post()) && $model->createLink()) {
            $this->redirect(['index', 'group' => $id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = LinkGroup::findOne($id);
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
        $model = LinkGroup::findOne($id);
        LinkGroup::deleteAll(['id' => $model->id]);
        $model->delete();
        $this->redirect(['index', 'group' => $model->group_id]);
    }
}
