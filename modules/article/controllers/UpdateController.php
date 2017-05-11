<?php

namespace modules\article\controllers;

use common\extend\UserInfo;
use common\util\Request;
use LayUI\components\Html;
use modules\admin\base\AuthController;
use modules\article\models\Article;
use modules\article\models\ArticleField;
use yii\base\Exception;
use yii\base\InvalidParamException;

class UpdateController extends AuthController
{
    public function actionIndex($id) {
        $articleModel       = Article::findOne($id);

        $typeFields = ArticleField::getTypeFieldList($articleModel->type);
        if (Request::isPost()) {
            $trans = \Yii::$app->getDb()->beginTransaction();
            try {
                # save article main data
                $articleModel->title       = Request::input("title");
                $articleModel->user_id     = UserInfo::getID();
                $articleModel->category_id = Request::input("category_id");
                $articleModel->index_show  = Request::input("index_show");
                if (!$articleModel->save()) {
                    throw new Exception(json_encode($articleModel->getFirstErrors()));
                }
                $articleID = $articleModel->primaryKey;

                foreach ($typeFields as $field) {
                    $field['class']::field([
                        'action'    => 'updateData',
                        'config'    => $field,
                        'fieldData' => Request::post($field['name']),
                        'dataID'    => $articleID,
                    ]);
                }

                $trans->commit();
            } catch (\Exception $e) {
                $trans->rollBack();
                return $this->renderFailed($e->getMessage());
            }


            return $this->renderSuccess(null, [
                Html::linkButton("继续编辑", ['/article/update', 'id' => $articleModel->id]),
            ]);
        }

        return $this->render('index', [
            'model'      => $articleModel,
            'typeFields' => $typeFields,
        ]);
    }
}
