<?php

namespace modules\uploader\controllers;

use application\base\RestController;
use common\util\Request;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class UploadController extends RestController
{
    public function actionIndex() {
        if (!Request::isPost()) {
            throw new NotFoundHttpException;
        }

        $file             = UploadedFile::getInstanceByName("ajax-file-upload");
        $saveFileName     = sprintf("%s-%s.%s", date("Y/m/d/His"), mt_rand(10000, 99999), $file->getExtension());
        $saveFullPathName = \Yii::getAlias(sprintf("@upload/%s", $saveFileName));

        $savePath         = dirname($saveFullPathName);
        if (!is_dir($savePath)) {
            FileHelper::createDirectory($savePath);
        }

        if ($file->saveAs($saveFullPathName)) {
            return [
                'code' => 0,
                'msg'  => '上传成功',
                'data' => [
                    'path' => $saveFileName,
                ],
            ];
        }

        return [
            'code' => 1,
            'msg'  => '上传失败',
            'data' => [
                'error' => $file->error,
            ],
        ];
    }
}
