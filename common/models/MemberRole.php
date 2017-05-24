<?php

namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "member_role".
 *
 * @property integer $id
 * @property string  $title
 * @property integer $pid
 * @property string  $rights
 */
class MemberRole extends \common\base\ActiveRecord
{
    public static function tableName()
    {
        return 'member_role';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['pid'], 'integer'],
            [['rights'], 'string'],
            [['title'], 'string', 'max' => 30],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'     => 'ID',
            'title'  => 'Title',
            'pid'    => 'Pid',
            'rights' => 'Rights',
        ];
    }

    public static function getList()
    {
        $models = self::findAll([]);

        return ArrayHelper::map($models, 'id', 'title');
    }
}
