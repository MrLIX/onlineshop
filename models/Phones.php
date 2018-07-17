<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "phones".
 *
 * @property int $id
 * @property string $phone
 * @property string $langs
 */
class Phones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone'], 'string', 'max' => 255],
            [['lang_ru','lang_uz','lang_en'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone' => Yii::t('app', 'Phone'),
            'lang_ru' => Yii::t('app', 'Ru'),
            'lang_uz' => Yii::t('app', 'Uz'),
            'lang_en' => Yii::t('app', 'En'),
        ];
    }
}
