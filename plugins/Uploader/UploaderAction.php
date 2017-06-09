<?php

namespace plugins\Uploader;

use common\traits\Setting;
use common\util\AliOSS;
use common\util\Request;
use yii\base\Action;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class UploaderAction extends Action
{
    use Setting;

    public function run()
    {
        if (!Request::isPost()) {
            throw new NotFoundHttpException;
        }

        $uploadInstance = UploadedFile::getInstanceByName("ajax-file-upload");
        $saveFileName   = sprintf("%s-%s.%s", date("Y/m/d/His"), mt_rand(10000, 99999), $uploadInstance->getExtension());

        $uploadedFiles = [];
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

            $uploadedFiles[] = $saveFileName;
        } catch (\Exception $e) {
            return json_encode([
                'error' => $e->getMessage(),
            ]);
        }

        return json_encode($uploadedFiles);
    }
}

