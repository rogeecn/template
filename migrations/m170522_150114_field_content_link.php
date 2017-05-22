<?php

namespace migrations;

use yii\db\Migration;

class m170522_150114_field_content_link extends Migration
{
    public $_table = "{{%field_content_link}}";

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'      => $this->primaryKey(),
            'style'   => $this->string(20)->notNull()->defaultValue(""),
            'tag'     => $this->string(20)->notNull()->defaultValue(""),
            'link'    => $this->string(122)->notNull()->defaultValue(""),
            'content' => $this->string(500),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
