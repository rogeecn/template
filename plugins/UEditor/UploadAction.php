<?php

namespace plugins\UEditor;

use common\util\Request;
use yii\base\Action;

class UploadAction extends Action
{
    public function run()
    {
        $action = Request::input("action");
        switch ($action) {
            case 'config':
                $result = Loader::run("config");
                break;
            /* 上传图片 */
            case 'uploadimage':
                $result = Loader::run("uploadImage");
                break;
            /* 上传涂鸦 */
            case 'uploadscrawl':
                $result = Loader::run("uploadScrawl");
                break;
            /* 上传视频 */
            case 'uploadvideo':
                $result = Loader::run("uploadVideo");
                break;
            /* 上传文件 */
            case 'uploadfile':
                $result = Loader::run("uploadFile");
                break;

            /* 列出图片 */
            case 'listimage':
                $result = Loader::run("listImage");
                break;
            /* 列出文件 */
            case 'listfile':
                $result = Loader::run("listFile");
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                set_time_limit(0);
                $result = Loader::run("cacheImage");
                break;

            default:
                $result = [
                    'state' => '请求地址出错',
                ];
                break;
        }

        $callback = Request::input("callback");
        if ($callback) {
            if (preg_match('/^[\w_]+$/', $callback)) {
                $data = sprintf("%s(%s)", htmlspecialchars($callback), json_encode($result));
                echo $data;
                exit;
            }

            return json_encode([
                'state' => 'callback参数不合法',
            ]);
        }

        return json_encode($result);
    }
}
