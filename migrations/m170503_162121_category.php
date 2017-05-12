<?php
namespace migrations;

use yii\db\Migration;

class m170503_162121_category extends Migration
{
    public $_table = '{{%category}}';

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'    => $this->primaryKey(),
            'name'  => $this->string(120)->notNull(),
            'alias' => $this->string(120)->notNull()->defaultValue(""),
            'path'  => $this->string(1200)->notNull()->defaultValue(""),
            'pid'   => $this->integer()->notNull()->defaultValue(0),
            'order'   => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable($this->_table);
    }
}
