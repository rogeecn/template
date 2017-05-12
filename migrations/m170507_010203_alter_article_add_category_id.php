<?php
namespace modules\article\migrations;

use yii\db\Migration;

class m170507_010203_alter_article_add_category_id extends Migration
{
    public $_table = "{{%article}}";

    public function safeUp() {
        $sql = $this->integer()->notNull()->after("id")->defaultValue(0);
        $this->addColumn($this->_table, "category_id", $sql);
    }

    public function safeDown() {
        $this->dropColumn($this->_table, "category_id");
    }
}
