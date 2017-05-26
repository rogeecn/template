<?php
namespace modules\admin\controllers\backup;

use application\base\AuthController;
use common\util\Request;
use yii\db\Query;

class ConfigController extends AuthController
{
    public $dataList = [
        'field'    => [
            'label'       => '文章类型',
            'name'        => 'field',
            'description' => '文章类型',
            'tables'      => [
                'article_field',
                'article_type',
            ],
        ],
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

    public function actionIndex()
    {
        return $this->render("index", [
            'dataList' => $this->dataList,
        ]);
    }

    public function actionExport()
    {
        $typeList = Request::input("type");
        if (empty($typeList)) {
            return;
        }
        $typeList = array_keys($typeList);

        $retData = [];
        foreach ($typeList as $type) {
            if (!isset($this->dataList[$type])) {
                continue;
            }

            foreach ($this->dataList[$type]['tables'] as $table) {
                $retData[$table] = (new Query())->from($table)->all();
            }
        }

        $fileName = sprintf("config-%s.json", date("Ymd-H-i-s"));
        \Yii::$app->getResponse()->sendContentAsFile(json_encode($retData), $fileName);
    }

    public function actionImport()
    {
        if (!Request::isPost()) {
            return $this->redirect(['index']);
        }
        $configData = Request::input("config");
        $configData = json_decode($configData, true);

        foreach ($configData as $table => $data) {
            foreach ($data as $itemData) {
                $query = new Query();
                if (isset($itemData['id']) && $query->where(['id' => $itemData['id']])->from($table)->one()) {
                    $id = $itemData['id'];
                    unset($itemData['id']);
                    $query->createCommand()->update($table, $itemData, ['id' => $id])->execute();
                    continue;
                }
                $query->createCommand()->insert($table, $itemData)->execute();
            }
        }

        return $this->redirect(['index']);
    }
}