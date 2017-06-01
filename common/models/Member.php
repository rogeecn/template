<?php

namespace common\models;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property string  $username
 * @property string  $password
 * @property string  $email
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Member extends \common\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'created_at', 'updated_at'], 'required'],
            [['role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password', 'email'], 'string', 'max' => 255],
            [['username', 'email'], 'unique'],
            ['status', 'in', 'range' => [self::ST_ENABLE, self::ST_DISABLE, self::ST_REMOVED]],
            ['status', 'default', 'value' => self::ST_ENABLE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'username'   => 'Username',
            'password'   => 'Password',
            'email'      => 'Email',
            'role'       => 'Role',
            'status'     => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
