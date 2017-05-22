<?php
namespace modules\admin\controllers\backup;

use application\base\AuthController;
use common\util\Request;
use yii\db\Query;

class ExportController extends AuthController
{
    public function actionIndex()
    {
        $dataList = [
            'category' => [
                'label'       => '分类',
                'name'        => 'category',
                'description' => '分类信息',
                'tables'      => [
                    'category',
                ],
            ],
            'setting'  => [
                'label'       => '网站配置',
                'name'        => 'setting',
                'description' => '网站配置',
                'tables'      => [
                    'setting',
                ],
            ],
            'link'     => [
                'label'       => '链接管理',
                'name'        => 'link',
                'description' => '链接管理',
                'tables'      => [
                    'link_group',
                ],
            ],
        ];

        $typeList = Request::input("type");
        if (!empty($typeList)) {
            $typeList = array_keys($typeList);

            $retData = [];
            foreach ($typeList as $type) {
                if (!isset($dataList[$type])) {
                    continue;
                }

                foreach ($dataList[$type]['tables'] as $table) {
                    $retData[$table] = (new Query())->from($table)->all();
                }
            }

            \Yii::$app->getResponse()->sendContentAsFile(json_encode($retData), "config.json");

            return;
        }


        return $this->render("export", [
            'dataList' => $dataList,
        ]);
    }
}