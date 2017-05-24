<?php

namespace modules\admin\controllers\member;

use application\base\AuthController;
use common\User;
use Yii;
use yii\web\NotFoundHttpException;

class UpdateController extends AuthController
{
    public function actionIndex($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->renderSuccess("编辑成功", [
                \plugins\LayUI\components\Html::linkButton("继续编辑", ['/admin/member/update', 'id' => $id]),
                \plugins\LayUI\components\Html::linkButton("返回列表", ['/admin/member/list']),
            ]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== NULL) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
