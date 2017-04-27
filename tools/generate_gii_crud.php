<?php
$class = $argv[1];

$command_tpl = "php yii gii/crud --enablePjax=1  ";
$command_tpl .= "--modelClass='common\\models\\{_NAME_}' ";
$command_tpl .= "--overwrite=1 ";
$command_tpl .= "--searchModelClass='common\\models\\search\\{_NAME_}' ";
$command_tpl .= "--controllerClass='application\\controllers\\{_NAME_}Controller' ";
$command_tpl .= "--viewPath='application\\views\\{_NAME_}' ";
$command_tpl .= "--interactive=0";

$command = strtr($command_tpl, ['{_NAME_}' => ucfirst($class)]);
echo "Command: " . $command . "\n";

$retVal = [];
system($command, $retVal);
print_r($retVal);
echo "\n\n\n\n";