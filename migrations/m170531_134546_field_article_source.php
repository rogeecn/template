<?php

namespace migrations;

use yii\db\Migration;

class m170531_134546_field_article_source extends Migration
{
    public $_table = "{{%field_article_source}}";

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'         => $this->primaryKey(),
            'source_url' => $this->string(500)->notNull()->defaultValue(""),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
