<?php

namespace migrations;

use yii\db\Migration;

class m170523_144356_field_announcement_article extends Migration
{
    public $_table = "{{%field_announcement_article}}";

    public function safeUp()
    {
        $tableOptions = NULL;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'      => $this->primaryKey(),
            'checked' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
