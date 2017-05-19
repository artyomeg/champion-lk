<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

use app\models\Training;
use app\models\User;

$this->title = 'Отчеты о тренировках';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php

        $user = User::find()->where(['email' => Yii::$app->user->identity->email])->one();
        
        $dataProvider = new ActiveDataProvider([
            'query' => Training::find()->where(['card_id' => $user->card_id])->orderBy('date DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_report',
            'layout' => "{items}\n{pager}",
            'emptyText' => '<div class="row">
                    <h5>
                        Данные о тренировках отсутствуют.
                    </h5>
                </div>',
        ]);
    ?>
    
</div>

