<?php
namespace console\controllers\tool;


use console\base\ConsoleController;

class ModuleController extends ConsoleController
{
    public function actionIndex($name)
    {
        $cmd = 'php yii gii/module --interactive=0 --moduleClass="application\modules\%s\Module" --moduleID=%s';
        $cmd = sprintf($cmd, $name, $name);
        system($cmd, $return);

        echo implode("\n", $return);

        echo "\n==========[ config code ]========\n";
        echo <<<_CODE
        '$name' => [
            'class' => 'application\modules\\$name\Module',
        ],
_CODE;
        echo "\n";
    }
}