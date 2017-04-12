<?php

namespace app\models;

use yii\base\NotSupportedException;
use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {
    
    public static function tableName() {
        return '{{%user}}';
    }

    public static function findIdentity($id) {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

//    public static function findByUsername($username) {
//        return static::findOne(['username' => $username]);
//    }
    
    public static function findByEmail($email) {
        return static::findOne(['email' => $email]);
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password) {
        $result = (md5($password) === $this->password);
//        $result = Yii::$app->security->validatePassword($password, $this->password_hash);;
        
        return $result;
    }

}
