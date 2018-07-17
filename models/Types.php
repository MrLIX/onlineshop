<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "types".
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_en
 * @property int $status
 */
class Types extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name_ru', 'name_en'], 'string', 'max' => 255],
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
