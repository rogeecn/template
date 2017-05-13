<?php
namespace common\base;


class ActiveRecord extends \yii\db\ActiveRecord
{
    const ST_ENABLE  = 0;
    const ST_DISABLE = 1;
    const ST_REMOVED = 2;

    public static function getStatusList() {
        return [
            self::ST_ENABLE  => '正常',
            self::ST_DISABLE => '禁用',
            self::ST_REMOVED => '删除',
        ];
    }

    public static function getStatusValue($id) {
        $list = self::getStatusList();
        return $list[$id];
    }

    public function getFlatErrors() {
        $errors = $this->getErrors();

        $flatErrors = [];
        foreach ($errors as $field => $error) {
            $flatErrors[$field] = implode(",", $error);
        }
        return $flatErrors;
    }
}