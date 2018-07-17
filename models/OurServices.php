<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "our_services".
 *
 * @property int $id
 * @property string $path
 * @property string $title_ru
 * @property string $title_en
 * @property string $content_ru
 * @property string $content_en
 * @property string $color
 * @property int $order
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class OurServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'our_services';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
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
            [['content_ru', 'content_en'], 'string'],
            [['order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title_ru', 'title_en', 'color'], 'string', 'max' => 255],
            [['path'],'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'path' => Yii::t('app', 'Path'),
            'title_ru' => Yii::t('app', 'Title Ru'),
            'title_en' => Yii::t('app', 'Title En'),
            'content_ru' => Yii::t('app', 'Content Ru'),
            'content_en' => Yii::t('app', 'Content En'),
            'color' => Yii::t('app', 'Text Background Color'),
            'order' => Yii::t('app', 'Order'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    public function getTitle(){

        if (Yii::$app->language == 'ru'):  return $this->title_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->title_en;

        endif;
    }

    public function getContent(){

        if (Yii::$app->language == 'ru'):  return $this->content_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->content_en;

        endif;
    }
}
