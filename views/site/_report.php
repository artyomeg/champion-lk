<?php
    use yii\helpers\Html;
    use yii\helpers\HtmlPurifier;
?>
 
    <div class="row">
        <h3>
            <?= Html::encode(date("d.m.Y", strtotime($model->date))) ?>	
        </h3>
        <p>
            Занятие: <?= Html::encode($model->title) ?>	
        </p>
        <p>
            <?php
                if ($model->coach) {
                    ?>
                        Тренер: 
                    <?php
                    echo $model->coach;
                }
            ?>
        </p>
    </div>