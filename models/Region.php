<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string $region
 *
 * @property Rayon[] $rayons
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region'], 'required'],
            [['region'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'region' => Yii::t('app', 'Region'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRayons()
    {
        return $this->hasMany(Rayon::className(), ['region_id' => 'id']);
    }
}
