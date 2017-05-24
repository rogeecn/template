<?php

namespace modules\admin\controllers\member;

use application\base\AuthController;
use common\User;
use yii\web\NotFoundHttpException;

class DeleteController extends AuthController
{
    public function actionIndex($id)
    {
        $model         = $this->findModel($id);
        $model->status = User::ST_REMOVED;
        $model->save(FALSE);

        return $this->renderSuccess("删除成功", [
            \plugins\LayUI\components\Html::linkButton("返回列表", ['/admin/member/list']),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== NULL) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
