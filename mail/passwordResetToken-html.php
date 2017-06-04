<?php
 
use yii\helpers\Html;
 
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);

//$card = Card::find()->where(['card_id' => $user->card_id])->one();

?>
 
<div class="password-reset">
    <p>Перейдите по ссылке, чтобы восстановить пароль:</p>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>