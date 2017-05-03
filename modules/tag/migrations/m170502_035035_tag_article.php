<?php
namespace modules\tag\migrations;

use yii\db\Migration;

class m170502_035035_tag_article extends Migration
{
    public $_table = "{{%tag_article}}";

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'         => $this->primaryKey(),
            'tag_id'     => $this->integer()->notNull(),
            'article_id' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable($this->_table);
    }
}
