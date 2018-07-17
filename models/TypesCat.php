<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "types_cat".
 *
 * @property int $sub_category_id
 * @property int $types_id
 *
 * @property SubCategory $subCategory
 * @property Types $types
 */
class TypesCat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'types_cat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_category_id', 'types_id'], 'integer'],
            [['sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategory::className(), 'targetAttribute' => ['sub_category_id' => 'id']],
            [['types_id'], 'exist', 'skipOnError' => true, 'targetClass' => Types::className(), 'targetAttribute' => ['types_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sub_category_id' => Yii::t('app', 'Sub Category ID'),
            'types_id' => Yii::t('app', 'Types ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory()
    {
        return $this->hasOne(SubCategory::className(), ['id' => 'sub_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasOne(Types::className(), ['id' => 'types_id']);
    }
}
