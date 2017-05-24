<?php
namespace migrations;

use yii\db\Migration;

class m170523_145356_member extends Migration
{
    public function safeUp()
    {
        $tableOptions = NULL;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%member}}', [
            'id'         => $this->primaryKey(),
            'username'   => $this->string()->notNull()->unique(),
            'password'   => $this->string()->notNull(),
            'email'      => $this->string()->notNull()->unique(),
            'role'       => $this->integer(),
            'status'     => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%member}}', [
            'username'   => 'rogeecn',
            'email'      => '123@qq.com',
            'password'   => 'Admin.123',
            'role'       => 1,
            'status'     => \common\User::ST_ENABLE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%member}}');
    }
}
