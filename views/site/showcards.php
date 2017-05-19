<?php
    use app\models\Card;
    use yii\data\ActiveDataProvider;
//    use yii\widgets\GridView;
    use yii\grid\GridView;
?>
    <h1>Клубные карты</h1>
    
    <?php
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
                'current_subscription',

//                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>