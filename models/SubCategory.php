<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title_ru
 * @property string $title_en
 * @property int $status
 *
 * @property Colors[] $colors
 * @property Products[] $products
 * @property Category $category
 * @property Types[] $types
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    public function behaviors()
    {
        return [

            [
                'class' => '\app\components\FileUploadBehaviour'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id', 'status'], 'integer'],
            [['title_ru', 'title_en'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['path',], 'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'title_ru' => Yii::t('app', 'Title Ru'),
            'title_en' => Yii::t('app', 'Title En'),
            'status' => Yii::t('app', 'Status'),
            'path' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColors()
    {
        return $this->hasMany(Colors::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasMany(Types::className(), ['category_id' => 'id']);
    }
    public function getTitle(){

        if (Yii::$app->language == 'ru'):  return $this->title_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->title_en;

        endif;
    }
}
