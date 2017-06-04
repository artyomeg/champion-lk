<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscription".
 *
 * @property string $id
 * @property string $card_id
 * @property string $title
 * @property string $uid
 * @property string $first_visit_date
 * @property string $expiration_date
 */
class Subscription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_id'], 'required'],
            [['card_id'], 'number'],
            [['first_visit_date', 'expiration_date'], 'safe'],
            [['title', 'uid'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_id' => 'Card ID',
            'title' => 'Subscription Title',
            'uid' => 'Uid',
            'first_visit_date' => 'First Visit Date',
            'expiration_date' => 'Expiration Date',
        ];
    }
}
