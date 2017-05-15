<?php

namespace modules\admin\controllers\article;

use common\base\Field;
use common\extend\UserInfo;
use common\util\Request;
use plugins\LayUI\components\Html;
use application\base\AuthController;
use common\models\ArticleField;
use common\models\Article;
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
                Html::linkButton("继续编辑", ['/admin/article/update', 'id' => $articleModel->id]),
                Html::linkButton("返回列表", ['/admin/article/manage']),
            ]);
        }

        return $this->render('index', [
            'model'      => $articleModel,
            'typeFields' => $typeFields,
        ]);
    }
}
