<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery_price".
 *
 * @property int $id
 * @property int $from
 * @property int $to
 * @property int $order
 */
class DeliveryPrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'delivery_price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'to', 'order','price'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from' => Yii::t('app', 'From'),
            'to' => Yii::t('app', 'To'),
            'price' => Yii::t('app', 'Price'),
            'order' => Yii::t('app', 'Order'),
        ];
    }
}
