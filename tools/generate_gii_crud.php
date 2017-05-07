<?php
$class = $argv[1];
$module = $argv[2];

if ($argc !==3){
    echo "php tools/generate_gii_crud.php model module";
    return ;
}

$command_tpl = "php yii gii/crud --enablePjax=1  ";
$command_tpl .= "--modelClass='modules\\models\\{_NAME_}' ";
$command_tpl .= "--overwrite=1 ";
$command_tpl .= "--searchModelClass='modules\\models\\{_NAME_}Search' ";
$command_tpl .= "--controllerClass='modules\\{$module}\\controllers\\{_NAME_}Controller' ";
$command_tpl .= "--viewPath='application\\views\\{_NAME_}' ";
$command_tpl .= "--interactive=0";

$command = strtr($command_tpl, ['{_NAME_}' => ucfirst($class)]);
echo "Command: " . $command . " \n";

$retVal = [];
system($command, $retVal);
print_r($retVal);
echo "\n\n\n\n";