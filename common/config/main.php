<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [
                        'position' => \yii\web\View::POS_HEAD
                    ],
                ],
            ],
        ],
        'formatter' => [
            'dateFormat'     => 'yy-MM-dd',
            'datetimeFormat' => 'yy/MM/dd HH:i:s',
            'timeFormat'     => 'H:i:s',
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
