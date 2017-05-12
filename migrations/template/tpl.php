<?php
echo "<?php\n";
$classSplit = explode("_",$className,3);
if (strpos($classSplit[2] , "alter_") === 0){
    $classSplit = explode("_",$classSplit[2],2);

    $tableName = $classSplit[1];
}else{
    $tableName = $classSplit[2];
}

?>

namespace migrations;

use yii\db\Migration;

class <?=$className?> extends Migration
{
    public $_table = "{{%<?=$tableName?>}}";

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_table, [
            'id'          => $this->primaryKey(),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable($this->_table);
    }
}
