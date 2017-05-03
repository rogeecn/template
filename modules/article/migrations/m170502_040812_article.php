<?php
namespace modules\article\migrations;

use yii\db\Migration;

class m170502_040812_article extends Migration
{
    public $_table = "{{%article}}";
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table,[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(240)->notNull(),
            'user_id'=>$this->integer()->notNull(),
            'type'=>$this->integer()->notNull(),
            'index_show'=>$this->integer()->notNull(),
            'status'=>$this->integer()->notNull(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
        ],$tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
