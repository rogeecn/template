<?php

namespace migrations;

use yii\db\Migration;

class m170524_075329_member_role extends Migration
{
    public $_table = "{{%member_role}}";

    public function safeUp()
    {
        $tableOptions = NULL;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'     => $this->primaryKey(),
            'title'  => $this->string(30)->notNull()->defaultValue(""),
            'pid'    => $this->integer()->notNull()->defaultValue(0),
            'rights' => $this->text(),
        ], $tableOptions);

        $this->insert($this->_table, [
            'title'  => '管理员',
            'pid'    => 0,
            'rights' => "[]",
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
