<?php

namespace modules\admin\controllers\member;

use application\base\AuthController;
use common\extend\BSHtml;
use common\User;
use Yii;

class CreateController extends AuthController
{
    public function actionIndex()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->renderSuccess("添加成功", [
                BSHtml::buttonLink("继续添加", ['/admin/member/create']),
            ]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
