<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [
                'migrations',
                'modules\tag\migrations',
                'modules\article\migrations',
                'modules\setting\migrations',
                'modules\category\migrations'
            ],
        ],
    ],
];
