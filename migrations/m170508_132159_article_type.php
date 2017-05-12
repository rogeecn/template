<?php
namespace modules\article\migrations;

use yii\db\Migration;

class m170508_132159_article_type extends Migration
{
    public $_table = "{{%article_type}}";

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(255)->notNull(),
            'alias'       => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'order'       => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable($this->_table);
    }
}

