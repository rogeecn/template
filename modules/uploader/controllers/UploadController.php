<?php

namespace modules\uploader\controllers;

use application\base\RestController;
use common\util\AliOSS;
use common\util\Request;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class UploadController extends RestController
{
    public function actionIndex()
    {
        if (!Request::isPost()) {
            throw new NotFoundHttpException;
        }

        $uploadInstance = UploadedFile::getInstanceByName("ajax-file-upload");
        $saveFileName   = sprintf("%s-%s.%s", date("Y/m/d/His"), mt_rand(10000, 99999), $uploadInstance->getExtension());
        try {

            $saveToOss = $this->setting("oss.enable");
            if ($saveToOss) {
                AliOSS::instance()->uploadFile($saveFileName, $uploadInstance->tempName);
            } else {
                $saveFullPathName = \Yii::getAlias(sprintf("@upload/%s", $saveFileName));
                $savePath         = dirname($saveFullPathName);
                if (!is_dir($savePath)) {
                    FileHelper::createDirectory($savePath);
                    if (!is_dir($savePath)) {
                        throw new Exception("dir create failed!");
                    }
                }

                if (!$uploadInstance->saveAs($saveFullPathName)) {
                    throw new Exception($uploadInstance->error);
                }
            }
        } catch (\Exception $e) {
            return [
                'code' => 1,
                'msg'  => '上传失败',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
        }

        return [
            'code' => 0,
            'msg'  => '上传成功',
            'data' => [
                'path' => $saveFileName,
            ],
        ];

    }
}
