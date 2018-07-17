<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "colors".
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_en
 * @property string $color
 * @property int $status
 */
class Colors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ru', 'name_en'], 'required'],
            [['status'], 'integer'],
            [['name_ru', 'name_en', 'color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_ru' => Yii::t('app', 'Name Ru'),
            'name_en' => Yii::t('app', 'Name En'),
            'color' => Yii::t('app', 'Color'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    public function getTitle(){

        if (Yii::$app->language == 'ru'):  return $this->name_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->name_en;

        endif;
    }
}
