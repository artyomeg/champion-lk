<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Регистрация в личном кабинете';
//    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Если вы уже регистрировались нажмите <a href="/login">Вход</a></p>
    <div class="row">
        <div class="col-lg-5">
 
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'card_id')->textInput(['autofocus' => true, 'placeholder' => 'Все цифры указанные под штрихкодом']) ?>
                <?= $form->field($model, 'email')->textInput(['placeholder' => 'Ваш e-mail']) ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Придумайте и запомните свой пароль']) ?>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
 
        </div>
    </div>
</div>