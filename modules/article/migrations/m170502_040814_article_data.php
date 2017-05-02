<?php
namespace modules\article\migrations;

use yii\db\Migration;

class m170502_040814_article_data extends Migration
{
    public $_table = "{{%article_data}}";
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table,[
            'id'=>$this->primaryKey(),
            'show_image'=>$this->string(255)->notNull()->defaultValue(""),
            'description'=>$this->string(1200)->notNull()->defaultValue(""),
            'content'=>$this->text()->notNull(),
        ],$tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
