<?php
namespace console\controllers\tool;


use console\base\ConsoleController;

class CrudController extends ConsoleController
{
    public function actionIndex($model, $module)
    {
        $command_tpl = "php yii gii/crud --enablePjax=1  ";
        $command_tpl .= "--modelClass=common\\models\\{model} ";
        $command_tpl .= "--overwrite=1 ";
        $command_tpl .= "--searchModelClass=common\\models\\{model}Search ";
        $command_tpl .= "--controllerClass=modules\\{module}\\controllers\\{model}Controller ";
        $command_tpl .= "--viewPath=modules\\{module}\\views\\{model} ";
        $command_tpl .= "--interactive=0";

        $command = strtr($command_tpl, [
            '{model}'  => ucfirst($model),
            '{module}' => $module,
        ]);
        echo "Command: " . $command . " \n";

        $retVal = [];
        system($command, $retVal);
        print_r($retVal);
        echo "\n";
    }
}