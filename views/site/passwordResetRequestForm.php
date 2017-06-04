<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 
$this->title = 'Заявка на восстановление пароля';

$showDescript = true;

foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    $messages .= '<div class="alert alert-' . $key . '">' . $message . '</div>';
    
    if ($key == 'success') {
        $showDescript = false;
    }
        
//    Yii::$app->session->setFlash('flashMessage');
}
?>
 
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        if ($showDescript) {
            ?>
                <p>Пожалуйста, заполните ваш e-mail. На него будет отправлена ссылка на восстановление пароля.</p>
            <?php
        }
    ?>
    <div class="row">
        <div class="col-lg-5">
 
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                <?php
                    echo $messages;
                ?>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
 
        </div>
    </div>
</div>