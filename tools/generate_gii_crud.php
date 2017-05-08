<?php
$model = $argv[1];
$module = $argv[2];

if ($argc !==3){
    echo "php tools/generate_gii_crud.php model module";
    return ;
}

$command_tpl = "php yii gii/crud --enablePjax=1  ";
$command_tpl .= "--modelClass='modules\\{module}\\models\\{model}' ";
$command_tpl .= "--overwrite=1 ";
$command_tpl .= "--searchModelClass='modules\\{module}\\models\\{model}Search' ";
$command_tpl .= "--controllerClass='modules\\{module}\\controllers\\{model}Controller' ";
$command_tpl .= "--viewPath='modules\\{module}\\views\\{model}' ";
$command_tpl .= "--interactive=0";

$command = strtr($command_tpl, ['{model}' => ucfirst($model),'{module}'=>$module]);
echo "Command: " . $command . " \n";

$retVal = [];
system($command, $retVal);
print_r($retVal);
echo "\n\n\n\n";