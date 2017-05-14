<?php
return [
    'modules'       => [
        'admin'    => [
            'class' => 'modules\admin\Module',
        ],
        'ueditor'  => [
            'class' => 'modules\ueditor\Module',
        ],
        'uploader' => [
            'class' => 'modules\uploader\Module',
        ],
    ],
    'vendorPath'    => dirname(dirname(__DIR__)) . '/vendor',
    'components'    => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [
                        'position' => \yii\web\View::POS_HEAD,
                    ],
                ],
            ],
        ],
        'formatter'    => [
            'dateFormat'     => 'php:y/m/d',
            'datetimeFormat' => 'php:y/m/d H:i',
            'timeFormat'     => 'php:H:i:s',
        ],
    ],
    'controllerMap' => [
        'migrate' => [
            'class'               => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [
                'migrations',
            ],
        ],
    ],
];
