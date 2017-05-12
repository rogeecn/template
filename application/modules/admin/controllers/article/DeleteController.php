<?php

namespace application\modules\admin\controllers\article;

use common\base\Field;
use common\extend\UserInfo;
use common\util\Request;
use LayUI\components\Html;
use application\base\AuthController;
use common\models\ArticleField;
use common\models\Article;
use yii\base\Exception;
use yii\base\InvalidParamException;

class DeleteController extends AuthController
{
    public function actionIndex($id) {
        $articleModel       = Article::findOne($id);

        $typeFields = ArticleField::getTypeFieldList($articleModel->type);
        if (Request::isPost()) {
            $trans = \Yii::$app->getDb()->beginTransaction();
            try {
                if (!$articleModel->delete()) {
                    throw new Exception(json_encode($articleModel->getErrors()));
                }

                foreach ($typeFields as $field) {
                    $field['class']::field([
                        'action'    => Field::ACTION_DELETE,
                        'config'    => $field,
                        'dataID'    => $id,
                    ]);
                }

                $trans->commit();
            } catch (\Exception $e) {
                $trans->rollBack();
                return $this->renderFailed($e->getMessage());
            }


            return $this->renderSuccess(null, [
                Html::linkButton("返回列表", ['/article/manage']),
            ]);
        }

        return $this->render('index', [
            'model'      => $articleModel,
            'typeFields' => $typeFields,
        ]);
    }
}
