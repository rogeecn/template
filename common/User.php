<?php
namespace common;

use common\models\Member;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

class User extends Member implements IdentityInterface
{
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::ST_ENABLE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::ST_ENABLE]);
    }


    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return md5($this->email);
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return $password == $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function isAdmin()
    {
        return $this->role == 1;
    }
}
