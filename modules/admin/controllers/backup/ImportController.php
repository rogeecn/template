<?php
namespace modules\admin\controllers\backup;

use application\base\AuthController;
use common\util\Request;
use yii\db\Query;

class ImportController extends AuthController
{
    public function actionIndex()
    {
        $msg = "";
        if (Request::isPost()) {
            $data = Request::input("config");
            $data = json_decode($data, TRUE);

            $query = new Query();
            foreach ($data as $table => $data) {
                foreach ($data as $itemData) {
                    $query->createCommand()->insert($table, $itemData);
                }
            }
            $msg = "SUCCESS";
        }

        return $this->render("import", ['msg' => $msg]);
    }
}