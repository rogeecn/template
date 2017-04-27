<?php
namespace common\util;

use yii\helpers\Json as YiiJson;

class Json
{
    public static function success($data = []) {
        return self::output(0, "success", $data);
    }

    public static function error($data = [], $code = 1, $msg = "error") {
        return self::output($code, $msg, $data);
    }

    private static function output($code, $msg, $data) {
        if (php_sapi_name() !== "cli") {
            header("Content-Type: application/json;charset=utf-8");
        }
        $data = [
            'code'  => $code,
            'message' => $msg,
            'data'   => $data,
        ];
        return YiiJson::encode($data);
    }
}