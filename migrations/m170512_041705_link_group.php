<?php

namespace migrations;

use yii\db\Migration;

class m170512_041705_link_group extends Migration
{
    public $_table = "{{%link_group}}";

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'            => $this->primaryKey(),
            'alias'         => $this->string(240)->notNull(),
            'title'         => $this->string(240)->notNull(),
            'display'       => $this->integer()->notNull(), // 0:group, 1:value
            'group_id'      => $this->integer(11)->notNull()->defaultValue(0),
            'value'         => $this->string(1200)->notNull()->defaultValue(""),
            'type'          => $this->string(100)->notNull()->defaultValue(""),
            'order'          => $this->integer()->notNull()->defaultValue(0),
        ],$tableOptions);
    }

    public function safeDown() {
        $this->dropTable($this->_table);
    }
}
