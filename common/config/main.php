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
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset'             => [
                    'jsOptions' => [
                        'position' => \yii\web\View::POS_HEAD,
                    ],
                    'js'        => [
                        '//cdn.staticfile.org/jquery/3.2.1/jquery.min.js',
                    ],
                ],
                'plugins\FontAwesome\FontAwesome' => [
                    'css' => [
                        '//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css',
                    ],
                ],
                'plugins\Carousel\CarouselAssets' => [
                    'js'  => [
                        '//cdn.staticfile.org/slick-carousel/1.6.0/slick.min.js',
                    ],
                    'css' => [
                        '//cdn.staticfile.org/slick-carousel/1.6.0/slick.min.css',
                        '//cdn.staticfile.org/slick-carousel/1.6.0/slick-theme.min.css',
                    ],
                ],
                'plugins\sortable\SortableAssets' => [
                    'js' => [
                        '//cdn.staticfile.org/jquery-sortable/0.9.13/jquery-sortable-min.js',
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
