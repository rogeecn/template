<?php
namespace application\controllers;

use application\base\WebController;
use common\models\Tag;
use yii\web\NotFoundHttpException;

class TagController extends WebController
{
    public function actionIndex($name)
    {
        $tagModel = Tag::getByTagName($name);
        if (!$tagModel) {
            throw new NotFoundHttpException();
        }
        $this->getView()->setTitle($name);

        return $this->render("/tag", [
            'tagName'   => $name,
            'tagInfo'   => $tagModel->toArray(),
            'page-type' => 'tag',
        ]);
    }
}
