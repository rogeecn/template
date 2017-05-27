<?php

namespace migrations;

use yii\db\Migration;

class m170527_102434_article_data extends Migration
{
    public $_table = "{{%article_data}}";


    public function longtext()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext');
    }

    public function safeUp()
    {
        $tableOptions = NULL;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->
        $this->createTable($this->_table, [
            'id'          => $this->primaryKey(),
            'description' => $this->string(255)->notNull()->defaultValue(""),
            'content'     => $this->longtext()->notNull()->defaultValue(""),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
