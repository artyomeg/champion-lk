<?php

namespace app\models;

use yii\base\NotSupportedException;
use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    
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
    
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function validatePassword($password) {
        return true;
//        $result = (md5($password) === $this->password_hash);
//        $result = Yii::$app->security->validatePassword($password, $this->password_hash);;
        
        if (!is_string($password) || $password === '') {
            return false;
        }

        if (!preg_match('/^\$2[axy]\$(\d\d)\$[\.\/0-9A-Za-z]{22}/', $hash, $matches)
            || $matches[1] < 4
            || $matches[1] > 30
        ) {
            return false;
        }

        if (function_exists('password_verify')) {
            return password_verify($password, $hash);
        }

        $test = crypt($password, $hash);
        $n = strlen($test);
        
        if ($n !== 60) {
            return false;
        }

        $result = $this->compareString($test, $hash);
        
        return $result;
    }
    
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

}
