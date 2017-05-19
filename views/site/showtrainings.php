<?php
    use app\models\Training;
    use yii\data\ActiveDataProvider;
    use yii\grid\GridView;
;?>
    <h1>Клубные карты</h1>
    
    <?php
        $dataProvider = new ActiveDataProvider([
            'query' => Training::find()
                ->select("card.fio,
                    training.card_id,
                    training.date,
                    training.title")
                ->innerJoin('card', 'training.card_id = card.card_id'),
        ]);
    ?>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],

                'fio',
                'card_id',
                'date',
                'title',

//                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>