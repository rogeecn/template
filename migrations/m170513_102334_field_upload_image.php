<?php

namespace migrations;

use yii\db\Migration;

class m170513_102334_field_upload_image extends Migration
{
    public $_table = "{{%field_upload_image}}";

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'    => $this->primaryKey(),
            'image' => $this->string(1024)->notNull()->defaultValue(""),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable($this->_table);
    }
}
