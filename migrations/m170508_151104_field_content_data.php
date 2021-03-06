<?php
namespace migrations;

use yii\db\Migration;

class m170508_151104_field_content_data extends Migration
{
    public $_table = "{{%field_content_data}}";

    public function longtext()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext');
    }

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'          => $this->primaryKey(),
            'description' => $this->string(1200)->notNull()->defaultValue(""),
            'content'     => $this->longtext()->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
