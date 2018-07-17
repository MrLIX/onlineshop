<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "colors_cat".
 *
 * @property int $sub_category_id
 * @property int $color_id
 *
 * @property SubCategory $subCategory
 * @property Colors $color
 */
class ColorsCat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colors_cat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_category_id', 'color_id'], 'integer'],
            [['sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategory::className(), 'targetAttribute' => ['sub_category_id' => 'id']],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colors::className(), 'targetAttribute' => ['color_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sub_category_id' => Yii::t('app', 'Sub Category ID'),
            'color_id' => Yii::t('app', 'Color ID'),
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
    public function getColor()
    {
        return $this->hasOne(Colors::className(), ['id' => 'color_id']);
    }
}
