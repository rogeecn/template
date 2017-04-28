<?php

namespace application\modules\dashboard\controllers;

use application\base\AuthController;
use application\base\RestController;

class TreeController extends RestController
{
    public function actionIndex()
    {

        /**
        {
        "text":"Books",
        "state":"open",
        "attributes":{
        "url":"/demo/book/abc",
        "price":100
        }
         */
        return [
            [
                'text'=>'DocumentRoot',
                'state'=>'open',
                'children'=>[
                        [
                            'text'=>'friend',
                            'attributes'=>[
                                'url'=>'http://baidu.com',
                            ],
                        ]
                ],
            ]
        ];
    }
}
