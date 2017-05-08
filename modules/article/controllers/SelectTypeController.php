<?php

namespace modules\article\controllers;

use modules\admin\base\AuthController;

class SelectTypeController extends AuthController
{
    public function actionIndex() {
        $typeList = [
            [
                'label'=>'文章',
                'description'=>'通用文章类型',
            ],
            [
                'label'=>'图片',
                'description'=>'图文',
            ]
        ];
        return $this->render('index', [
            'typeList' => $typeList,
        ]);
    }
}
