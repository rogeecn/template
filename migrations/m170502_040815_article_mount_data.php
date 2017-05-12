<?php
namespace migrations;

use yii\db\Migration;

class m170502_040815_article_mount_data extends Migration
{
    public $_table = "{{%article_mount_data}}";

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'    => $this->primaryKey(),
            'type'  => $this->string(255)->notNull()->defaultValue(""),
            'value' => $this->text()->notNull(),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable($this->_table);
    }
}
