<?php
    use app\models\Card;
    use yii\data\ActiveDataProvider;
//    use yii\widgets\GridView;
    use yii\grid\GridView;
;?>
    <h1>Клубные карты</h1>
    
    <?php
//        $cards = Card::find()->all();
//
//        
//        if (!empty($cards))
//            var_dump ($cards);
        
        $dataProvider = new ActiveDataProvider([
            'query' => Card::find(),
        ]);
    ?>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],

                'card_id',
                'fio',
                'last_operation',

//                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>