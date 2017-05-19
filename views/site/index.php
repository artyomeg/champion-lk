<?php
    use app\models\Card;
    use app\models\User;

    $this->title = 'Личный кабинет';
?>
<div class="site-index">

    <h1>Личный кабинет</h1>

    <div class="body-content">

        <div class="row">

            <h2>
                <?= $card->fio ?>
            </h2>

            <p>
                № клубной карты: <?= $card->card_id ?>
            </p>
            <p>
                Действующий абонемент: <?= 
                    ($card->current_subscription == '')
                        ? '<отсутствует>'
                        : $card->current_subscription . ' до ' . $card->subscription_finish
                ?>
            </p>
            
            <p>
                Посещение тренажерного зала: осталось <?= (int) $card->gym_ostalos ?> / приобретено <?= (int) $card->gym_vsego ?>
                <br/>
                Посещение групповых занятий: осталось <?= (int) $card->group_ostalos ?> / приобретено <?= (int) $card->group_vsego ?>
                <br/>
                Персональные тренировки: осталось <?= (int) $card->private_ostalos ?> / приобретено <?= (int) $card->private_vsego ?>
            </p>

            <p>
                Заморозка карты: 
                <?php
                    if ($card->unfreeze_date)
                        echo 'заморожено с ' . $card->freeze_date . ' до ' . $card->unfreeze_date;
                    else
                        echo 'отключено';
                ?>
            </p>

            <p>
                <i>Оставить заявку на заморозку абонемента:</i>
                <a class="btn btn-default" href="js:" data-toggle="modal" data-target="#_freeze">Перейти</a>
            </p>
            <p>
                <i>Написать письмо руководству клуба:</i>
                <a class="btn btn-default" href="js:" data-toggle="modal" data-target="#_sendletter">Перейти</a>
            </p>
        </div>
        
        <?php
//            $this->renderPartial('_index_freeze');
            echo Yii::$app->controller->renderPartial('_index_freeze');
            echo Yii::$app->controller->renderPartial('_index_sendletter');
        ?>
    </div>
</div>