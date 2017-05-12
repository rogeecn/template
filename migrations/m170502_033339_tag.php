<?php
namespace modules\tag\migrations;

use yii\db\Migration;

class m170502_033339_tag extends Migration
{
    public $_table = "{{%tag}}";

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'              => $this->primaryKey(),
            'name'            => $this->string(120)->notNull()->unique(),
            'reference_count' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable($this->_table);
    }
}
