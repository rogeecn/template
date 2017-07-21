<?php

namespace plugins\TinyMCE;

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

        $uploadInstance = UploadedFile::getInstanceByName("file");
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

            $saveFileName = rtrim($this->setting("site.static_path"), "/") . "/" . $saveFileName;
        } catch (\Exception $e) {
            header("HTTP/1.0 500 " . $e->getMessage());
            exit;
        }

        return json_encode(['location' => $saveFileName]);
    }
}

