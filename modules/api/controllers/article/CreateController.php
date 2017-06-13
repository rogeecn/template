<?php

namespace modules\api\controllers\article;

use application\base\WebController;
use common\base\Field;
use common\models\Article;
use common\models\ArticleField;
use common\util\Request;
use yii\base\Exception;

class CreateController extends WebController
{
    public $enableCsrfValidation = FALSE;

    public function actionIndex()
    {
        $type = Request::input("type");
        if (empty($type)) {
            return "fail: type is required";
        }

        $articleModel       = new Article();
        $articleModel->type = $type;

        $typeFields         = ArticleField::getTypeFieldList($type);
        $trans              = \Yii::$app->getDb()->beginTransaction();
        try {
            # save article main data
            $articleModel->title = Request::input("title");
            $articleModel->title = strtr($articleModel->title, [
                '_Javascript教程' => '',
                '&nbsp;'        => ' ',
                '_javascript技巧' => '',
                '-js教程'         => '',
                '_jquery'       => '',
            ]);
            $articleModel->title = trim($articleModel->title);
            if (empty($articleModel->title)) {
                throw new Exception("title is empty");
            }

            $articleModel->user_id     = 1;
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

            return "fail: " . $e->getMessage();
        }


        return "ok";
    }
}
