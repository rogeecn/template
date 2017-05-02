<?php

namespace modules\admin\controllers;

use application\base\RestController;
use yii\helpers\Url;

class TreeController extends RestController
{
    public function actionIndex()
    {

        /**
         * {
         * "text":"Books",
         * "state":"open",
         * "attributes":{
         * "url":"/demo/book/abc",
         * "price":100
         * }
         */
        return [
            [
                'text' => 'Dashboard',
                'attributes' => [
                    'url' => '/admin/dashboard',
                ],
            ],
            [
                'text' => 'DocumentRoot',
                'state' => 'open',
                'children' => [
                    [
                        'text' => 'UEditor',
                        'attributes' => [
                            'url' => Url::to(['/admin/uploader/show'])
                        ],
                    ],
                    [
                        'text' => 'Tag',
                        'attributes' => [
                            'url' => Url::to(['/tag'])
                        ],
                    ]
                ],
            ]
        ];
    }
}
