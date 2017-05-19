<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id'                  => 'application',
    'language'            => 'zh-CN',
    'defaultRoute'        => 'index',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'application\controllers',
    'bootstrap'           => ['log'],
    'modules'             => [
        'go' => [
            'class' => 'application\modules\go\Module',
        ],
    ],
    'components'          => [
        'user'         => [
            'identityClass'   => 'common\User',
            'enableAutoLogin' => true,
            'identityCookie'  => [
                'name'     => '_IDENTITY_APPLICATION',
                'httpOnly' => true,
            ],
        ],
        'session'      => [
            // this is the name of the session cookie used for login on the application
            'name' => 'SESS_APPLICATION',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],
        'urlManager'   => [
            'class' => 'common\extend\UrlManager',
        ],
        'request'      => [
            'csrfParam' => '_CSRF_APPLICATION',
            'parsers'   => [
                'application/json' => 'yii\web\JsonParser',
                'text/json'        => 'yii\web\JsonParser',
            ],
        ],
        'view'         => [
            'class' => 'common\extend\View',
            'theme' => [
                'basePath' => '@themes/basic',
                'baseUrl'  => '@themes/basic',
                'pathMap'  => [
                    '@application/views'   => '@themes/basic',
                    '@application/modules' => '@themes/basic/modules',
                ],
            ],
        ],
    ],
    'params'              => $params,
];
