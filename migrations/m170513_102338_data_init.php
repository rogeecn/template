<?php

namespace migrations;

use common\models\Setting;
use yii\db\Migration;

class m170513_102338_data_init extends Migration
{
    public $_table = "{{%setting}}";

    public function safeUp()
    {
        $this->truncateTable($this->_table);
        $data = [
            [
                'alias'   => 'site',
                'title'   => '网站设置',
                'columns' => [
                    ['url', '网站地址', Setting::TYPE_STRING],
                    ['logo', 'LOGO地址', Setting::TYPE_STRING],
                    ['name', '网站名称', Setting::TYPE_STRING],
                    ['slogan', '网站副标题', Setting::TYPE_STRING],
                    ['keyword', '关键字', Setting::TYPE_STRING],
                    ['description', '网站描述', Setting::TYPE_TEXT],
                    ['icp_number', 'ICP备案号', Setting::TYPE_STRING],
                    ['police_number', '公安备案号', Setting::TYPE_STRING],
                    ['theme', '网站主题', Setting::TYPE_STRING],
                    ['code_top', '页头代码', Setting::TYPE_TEXT],
                    ['code_bottom', '页尾代码', Setting::TYPE_TEXT],
                ],
            ],
            [
                'alias'   => 'update',
                'title'   => '网站维护',
                'columns' => [
                    ['updating', '是否维护中', Setting::TYPE_SINGLE_SELECT, "否\n是"],
                    ['show', '展示文案', Setting::TYPE_TEXT],
                ],
            ],
        ];

        foreach ($data as $group) {
            $model = new Setting();
            $model->setAttributes($group);
            $ret = $model->createGroup();
            if ($ret) {
                echo sprintf("Create Group %s success id: %d\n", $model->title, $model->primaryKey);

                if (!empty($group['columns'])) {
                    foreach ($group['columns'] as $column) {
                        $columnModel = new  Setting();
                        list($alias, $title, $type, $pre_configure) = $column;
                        $columnModel->setAttributes([
                            'group_id'      => $model->id,
                            'alias'         => $alias,
                            'title'         => $title,
                            'type'          => $type,
                            'pre_configure' => $pre_configure ?: "",
                        ]);
                        if ($columnModel->createColumn()) {
                            echo sprintf(">> Create Column %s success\n", $columnModel->title);
                            continue;
                        }

                        print_r($columnModel->getErrors());
                        exit;
                    }
                }
                continue;
            }
        }
    }

    public function safeDown()
    {
        $this->truncateTable($this->_table);
    }
}
