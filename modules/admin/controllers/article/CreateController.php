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

class CreateController extends AuthController
{
    public function actionIndex() {
        $type = Request::input("type");
        if (empty($type)) {
            throw new InvalidParamException("type is required");
        }

        $articleModel       = new Article();
        $articleModel->type = $type;

        $typeFields = ArticleField::getTypeFieldList($type);
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
                        'action'    => Field::ACTION_CREATE,
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
                Html::linkButton("继续添加", ['/admin/article/create', 'type' => $articleModel->type]),
            ]);
        }

        return $this->render('index', [
            'model'      => $articleModel,
            'typeFields' => $typeFields,
        ]);
    }
}
