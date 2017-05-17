<?php

/* @var $this yii\web\View */
use app\models\Card;
use app\models\User;


$this->title = 'Личный кабинет';

$card = Card::find()->where(['card_id' => Yii::$app->user->identity->card_id])->one();

//echo Yii::$app->user->identity->email;
?>
<div class="site-index">

    <h1>Личный кабинет</h1>

    <div class="body-content">

        <div class="row">

            <p>
                <?= $card->fio ?>
                <br/>
                18.10.1980
                <br/>
                Мужчина
            </p>

            <p>
                Действующие абонементы:
            </p>
            
            
            <p>
                Посещение тренажерного зала: осталось / приобретено
                <br/>
                Посещение групповых занятий: осталось / приобретено
                <br/>
                Персональные тренировки: осталось / приобретено
            </p>

            <p>
                Заморозка карты: отключено / заморожено с дд.мм.гггг до дд.мм.гггг
            </p>

            <p><a class="btn btn-default" href="/">Оставить заявку на заморозку абонемента &raquo;</a></p>
            <p><a class="btn btn-default" href="/">Написать письмо руководству клуба  &raquo;</a></p>
        </div>
        
    </div>
</div>