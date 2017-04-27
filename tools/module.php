<?php
$cmd = 'php yii gii/module --interactive=0 --moduleClass="application\modules\%s\Module" --moduleID=%s';

if ($argc == 1) {
    echo "CMD FORMAT: php module.php xxxx";
    exit;
}
$cmd = sprintf($cmd, $argv[1], $argv[1]);
system($cmd, $return);

echo implode("\n", $return);

echo "\n==========[ config code ]========\n";
echo <<<_CODE
        '$argv[1]' => [
            'class' => 'application\modules\\$argv[1]\Module',
        ],
_CODE;

echo "\n";
