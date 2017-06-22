<?php
namespace console\controllers;


use common\base\Field;
use common\models\Article;
use common\models\ArticleField;
use common\models\Tag;
use common\models\TagArticle;
use console\base\ConsoleController;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

class ClearEmptyContentController extends ConsoleController
{
    public function actionIndex()
    {
        $data   = \Yii::$app->getDb()->createCommand("select id from field_content_data where content = ''")->queryAll();
        $idList = ArrayHelper::getColumn($data, "id");

        foreach ($idList as $id) {
            $articleModel = Article::findOne($id);
            if (!$articleModel) {
                self::$_logger->info(sprintf("%d not exist...", $id));
                continue;
            }

            $typeFields = ArticleField::getTypeFieldList($articleModel->type);
            $trans      = \Yii::$app->getDb()->beginTransaction();
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


                self::$_logger->info(sprintf("%d remove successful...", $id));
                $trans->commit();
            } catch (\Exception $e) {
                $trans->rollBack();
                self::$_logger->info(sprintf("%d remove failed...", $id));
            }

        }
    }
}