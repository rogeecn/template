<?php
namespace migrations;

use yii\db\Migration;

class m170502_040813_sticky_article extends Migration
{
    public $_table = "{{%sticky_article}}";

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'         => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'order'      => $this->integer()->notNull()->defaultValue(0),
            'category'   => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable($this->_table);
    }
}
