<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "training".
 *
 * @property string $id
 * @property string $card_id
 * @property string $title
 * @property string $coach
 */
class Training extends \yii\db\ActiveRecord {
    public $fio;
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'training';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['card_id'], 'required'],
            [['card_id'], 'number'],
            [['title', 'coach'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'card_id' => 'Card ID',
            'title' => 'Title',
            'coach' => 'Coach',
        ];
    }

}
