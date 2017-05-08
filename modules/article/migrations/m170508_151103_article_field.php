<?php
namespace modules\article\migrations;

use yii\db\Migration;

class m170508_151103_article_field extends Migration
{
    public $_table = "{{%article_field}}";

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'          => $this->primaryKey(),
            'type_id'     => $this->integer()->notNull(),
            'label'       => $this->string(255)->notNull(),
            'name'        => $this->string(255)->notNull(),
            'options'     => $this->text()->notNull(),
            'description' => $this->string(255)->notNull(),
            'class'       => $this->string(255)->notNull(),
            'order'       => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable($this->_table);
    }
}

