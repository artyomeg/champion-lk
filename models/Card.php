<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "card".
 *
 * @property string $id
 * @property string $card_id
 * @property string $fio
 * @property string $last_operation
 */
class Card extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'card';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['card_id'], 'required'],
            [['card_id'], 'integer'],
            [['fio'], 'string', 'max' => 511],
            [['last_operation'], 'string', 'max' => 255],
            [['card_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'card_id' => 'Номер карты',
            'fio' => 'ФИО',
            'last_operation' => 'Последняя операция ',
        ];
    }

}
