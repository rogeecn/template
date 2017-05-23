<?php

namespace migrations;

use yii\db\Migration;

class m170523_140746_field_carousel extends Migration
{
    public $_table = "{{%field_carousel}}";

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'          => $this->primaryKey(),
            'link'        => $this->string(255)->notNull()->defaultValue(""),
            'description' => $this->string(255)->notNull()->defaultValue(""),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
