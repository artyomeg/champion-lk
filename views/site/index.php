<?php
    use app\models\Card;
    use app\models\User;
    use app\models\Subscription;

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
                Действующие абонементы: 
                
                <?php
                    $mySubscriptions = Subscription::find()->where(['card_id' => Yii::$app->user->identity->card_id])->all();
                    
                    $subscriptions = null;
                    
                    $datetimeNow = date_create(date("Y-m-d"));
                    
                    if (!empty($mySubscriptions)) {
                        foreach ($mySubscriptions as $subscription) {
                            $datetimeExpiration = date_create(date("Y-m-d", strtotime($subscription->first_visit_date)));
                            $interval = date_diff($datetimeNow, $datetimeExpiration);
                            //echo '<' . $interval->format('%R%a дней'). '>' ;
                            
                            // если прошла дата окончания абонемента
                            if ($datetimeNow > $datetimeExpiration)
                                continue;

                            $subscriptions .= 
                                '<br/>'
                                . $subscription->title
                                . ' — ';
                            
                            if ($subscription->first_visit_date || $subscription->expiration_date) {
                                // если указан первый визит
                                if ($subscription->first_visit_date)
                                    $subscriptions .=  
                                        ' с '
                                        . date("d.m.Y", strtotime($subscription->first_visit_date));

                                // если указана дата окончания
                                if ($subscription->expiration_date)
                                    $subscriptions .= 
                                        ' до '
                                        . date("d.m.Y", strtotime($subscription->expiration_date));

                                $subscriptions .=
                                    '.';
                            }
                            else 
                                $subscriptions .= 'первое посещение не зафиксировано';
                        }
                        
                        echo $subscriptions;
                    }
                    
                    // если не нашлось нормального абонемента
                    if (!$subscriptions)
                        echo '<дествующие абонементы отсутствуют>';
                        
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