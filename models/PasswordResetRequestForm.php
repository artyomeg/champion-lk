<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model {

    public $email;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['email', 'trim'],
            ['email', 'required', 'message' => '{attribute} не может быть пустым.'],
            ['email', 'email', 'message' => '{attribute} введен некорректно.'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
//                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Не найден пользователь с указанным e-mail.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail() {
        /* @var $user User */
        $user = User::findOne([
//            'status' => User::STATUS_ACTIVE,
                    'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['systemFromEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }

}
