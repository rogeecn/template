<?php
namespace migrations;

use yii\db\Migration;

class m170503_155111_alert_setting_add_column_order extends Migration
{
    public $_table = "{{%setting}}";

    public function safeUp() {
        $this->addColumn($this->_table, "order", $this->integer(11)->notNull()->defaultValue(0)->after("pre_configure"));
    }

    public function safeDown() {
        $this->dropColumn($this->_table, "order");
    }
}
