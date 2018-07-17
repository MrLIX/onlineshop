<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_products".
 *
 * @property int $id
 * @property int $orders_id
 * @property int $product_id
 * @property int $quantity
 * @property string $color
 * @property string $type
 * @property int $discount
 * @property int $product_price
 * @property int $status
 *
 * @property Orders $orders
 */
class OrderProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orders_id', 'product_id'], 'required'],
            [['orders_id', 'product_id', 'quantity', 'discount', 'product_price', 'status'], 'integer'],
            [['color', 'type'], 'string', 'max' => 255],
            [['orders_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['orders_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'orders_id' => Yii::t('app', 'Orders ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'color' => Yii::t('app', 'Color'),
            'type' => Yii::t('app', 'Type'),
            'discount' => Yii::t('app', 'Discount'),
            'product_price' => Yii::t('app', 'Product Price'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['id' => 'orders_id']);
    }
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
