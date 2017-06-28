<?php
namespace console\controllers\tool;


use console\base\ConsoleController;

class MigrationController extends ConsoleController
{
    public function actionIndex($name)
    {
        $cmd = 'php yii migrate/create --interactive=0 -F="@migrations/template/tpl.php" --migrationPath="@migrations" %s';
        $cmd = sprintf($cmd, $name);
        system($cmd, $return);

        echo implode("\n", $return);
        echo "\n";
    }
}