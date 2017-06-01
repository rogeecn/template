<?php

namespace modules\admin\controllers\article;

use application\base\AuthController;
use common\base\Field;
use common\models\Article;
use common\models\ArticleField;
use common\models\Tag;
use common\models\TagArticle;
use common\util\Request;
use plugins\LayUI\components\Html;
use yii\base\Exception;

class DeleteController extends AuthController
{
    public function actionIndex($id)
    {
        $articleModel = Article::findOne($id);

        $typeFields = ArticleField::getTypeFieldList($articleModel->type);
        if (Request::isPost()) {
            $trans = \Yii::$app->getDb()->beginTransaction();
            try {
                if (!$articleModel->delete()) {
                    throw new Exception(json_encode($articleModel->getErrors()));
                }

                foreach ($typeFields as $field) {
                    $field['class']::field([
                        'action' => Field::ACTION_DELETE,
                        'config' => $field,
                        'dataID' => $id,
                    ]);
                }

                $articleTags = TagArticle::getArticleTags($id);
                foreach ($articleTags as $articleTag) {
                    Tag::descTagReferenceCountByID($articleTag['id']);
                }

                TagArticle::removeArticle($id);

                $trans->commit();
            } catch (\Exception $e) {
                $trans->rollBack();

                return $this->renderFailed($e->getMessage());
            }


            return $this->renderSuccess(NULL, [
                Html::linkButton("返回列表", ['/admin/article/manage']),
            ]);
        }

        return $this->render('index', [
            'model'      => $articleModel,
            'typeFields' => $typeFields,
        ]);
    }
}
