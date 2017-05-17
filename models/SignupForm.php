<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $card_id;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['card_id', 'trim'],
            ['card_id', 'number', 'message' => '{attribute} может быть только числовым.'],
            ['card_id', 'required', 'message' => '{attribute} не может быть пустым.'],
            ['card_id', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Пользователь с этим номером карты уже зарегистрирован, восстановите пароль или обратитесь за помощью в клуб.'],
            ['card_id', 'string', 'min' => 2, 'max' => 255, 'tooShort' => "{attribute} не может быть меньше 2 символов.", 'tooLong' => "{attribute} не может быть больше 255 символов."],
            ['email', 'trim'],
            ['email', 'required', 'message' => '{attribute} не может быть пустым.'],
            ['email', 'email', 'message' => '{attribute} введен некорректно.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Пользователь с этим e-mail уже зарегистрирован, если это вы - восстановите пароль.'],
            ['password', 'required', 'message' => '{attribute} не может быть пустым.'],
            ['password', 'string', 'min' => 6, 'tooShort' => "{attribute} не может быть меньше 6 символов."],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'password' => 'Пароль',
            'email' => 'E-mail',
            'card_id' => 'Номер карты',
            'fio' => 'ФИО',
            'last_operation' => 'Последняя операция ',
        ];
    }
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if (!$this->validate())
            return null;

        $user = new User();
        $user->card_id = $this->card_id;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

}