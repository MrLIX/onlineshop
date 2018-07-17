<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property int $id
 * @property int $user_id
 * @property string $phone
 * @property string $name
 * @property int $region_id
 * @property int $index
 * @property string $address
 * @property string $number_dom
 * @property string $number_kv
 * @property string $lat
 * @property string $lng
 *
 * @property User $user
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'phone', 'name', 'region_id', 'index', 'address', 'number_dom', 'number_kv', 'lat', 'lng'], 'required'],
            [['user_id', 'region_id', 'index'], 'integer'],
            [['phone', 'name', 'address', 'number_dom', 'number_kv', 'lat', 'lng'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'phone' => Yii::t('app', 'Phone'),
            'name' => Yii::t('app', 'Name'),
            'region_id' => Yii::t('app', 'Region ID'),
            'index' => Yii::t('app', 'Index'),
            'address' => Yii::t('app', 'Address'),
            'number_dom' => Yii::t('app', 'Number Dom'),
            'number_kv' => Yii::t('app', 'Number Kv'),
            'lat' => Yii::t('app', 'Lat'),
            'lng' => Yii::t('app', 'Lng'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getRayon()
    {
        return $this->hasOne(Rayon::className(), ['id' => 'region_id']);
    }
}
