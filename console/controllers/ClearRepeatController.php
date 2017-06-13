<?php
namespace console\controllers;


use console\base\ConsoleController;
use yii\helpers\FileHelper;

class ClearRepeatController extends ConsoleController
{

    public function actionIndex()
    {
        $dir       = "D:\\SpiderData\\download_files\\2017";
        $file_list = FileHelper::findFiles($dir);

        $md5_list       = [];
        $block_md5_list = [
            "59F109047A69C5D3E0B95E403BDD243F",
            "8152E98D3A5AFAD8E0B42EDF9A1A001E",
            "7BC78885E984CA1FB625A620A22EBFBB",
        ];

        $fileCount    = count($file_list);
        $currentCount = $fileCount;
        foreach ($file_list as $file) {
            $fileMD5 = md5_file($file);;

            echo sprintf("[%d/%d] %s md5 %s ...\n", $currentCount--, $fileCount, $file, $fileMD5);
            if (in_array($fileMD5, $block_md5_list)) {
                unlink($file);
                continue;
            }

            if (in_array($fileMD5, $md5_list)) {
                echo "\n-------------[ DELETE ]--------------\n";
                $dstFile = str_replace("download_files", "download_files_repeat", $file);
                if (!is_dir(dirname($dstFile))) {
                    FileHelper::createDirectory(dirname($dstFile));
                }
                echo "DST: " . $dstFile . "\n";
                copy($file, $dstFile);
                unlink($file);
                continue;
            }
            $md5_list[] = $fileMD5;
        }
    }
}