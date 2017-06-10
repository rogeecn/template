<?php

namespace modules\admin\controllers\article;

use application\base\AuthController;
use common\base\Field;
use common\extend\BSHtml;
use common\extend\UserInfo;
use common\models\Article;
use common\models\ArticleField;
use common\util\Request;
use yii\base\Exception;

class UpdateController extends AuthController
{
    public function actionIndex($id)
    {
        $articleModel = Article::findOne($id);

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
                        'action'    => Field::ACTION_UPDATE,
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
                BSHtml::buttonLink("继续编辑", ['/admin/article/update', 'id' => $articleModel->id]),
                BSHtml::buttonLink("返回列表", ['/admin/article/manage']),
            ]);
        }

        return $this->render('/article/form', [
            'model'      => $articleModel,
            'typeFields' => $typeFields,
        ]);
    }
}
