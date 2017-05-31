<?php
return [
    'components' => [
        'db'     => [
            'class'               => 'yii\db\Connection',
            'dsn'                 => 'mysql:host='.SYSTEM_DB_HOST.';dbname=officejineng',
            'username'            => SYSTEM_DB_USER,
            'password'            => SYSTEM_DB_PASS,
            'charset'             => 'utf8',
            'enableSchemaCache'   => TRUE,
            'schemaCacheDuration' => 3600,
        ],
        'mailer' => [
            'class'    => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
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
                'yii\jui\JuiAsset'                => [
                    'js'  => [
                        '//cdn.staticfile.org/jqueryui/1.12.1/jquery-ui.min.js',
                    ],
                    'css' => [
                        '//cdn.staticfile.org/jqueryui/1.12.1/themes/smoothness/theme.min.css',
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
    ],
];
