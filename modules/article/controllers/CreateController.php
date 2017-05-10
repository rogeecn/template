<?php

namespace modules\article\controllers;

use common\extend\UserInfo;
use common\util\Json;
use common\util\Request;
use LayUI\components\Html;
use modules\admin\base\AuthController;
use modules\article\models\Article;
use modules\article\models\ArticleField;
use yii\base\Exception;
use yii\base\InvalidParamException;

class CreateController extends AuthController
{
    public function actionIndex() {
        $type = Request::input("type");
        if (empty($type)){
            throw new InvalidParamException("type is required");
        }

        $model = new Article();
        $model->type = $type;

        $typeFields = ArticleField::getTypeFieldList($type);
        if (Request::isPost()){
            $trans = \Yii::$app->getDb()->beginTransaction();
            try{
                # save article main data
                $articleModel = new Article();
                $articleModel->title = Request::input("title");
                $articleModel->user_id = UserInfo::getID();
                $articleModel->category_id = Request::input("category_id");
                $articleModel->index_show = Request::input("index_show");
                if (!$articleModel->save()){
                    throw new Exception(json_encode($articleModel->getFirstErrors()));
                }
                $articleID = $articleModel->primaryKey;

                foreach ($typeFields as $field){
                    $class = new $field['class']();
                    $data = [$articleID,Request::post($field['name'])];
                    call_user_func_array([$class,'saveData'], $data);
                }

                $trans->commit();
            }catch (\Exception $e){
                $trans->rollBack();
                return $this->renderFailed($e->getMessage());
            }


            return $this->renderSuccess(null,[
                Html::linkButton("继续添加",['/article/create','type'=>$model->type]),
            ]);
        }

        return $this->render('index', [
            'model' => $model,
            'typeFields' => $typeFields,
        ]);
    }
}
