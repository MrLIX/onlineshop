<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "carousel".
 *
 * @property int $id
 * @property string $base_url
 * @property string $path
 * @property string $product_id
 * @property string $title_ru
 * @property string $title_uz
 * @property string $content_ru
 * @property string $content_uz
 * @property string $price
 * @property int $order
 * @property int $created_at
 * @property int $updated_at
 */
class Carousel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carousel';
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
            [['title_ru', 'title_uz', 'content_ru', 'content_uz'], 'required'],
            [['content_ru', 'content_uz','url'], 'string'],
            [['order', 'created_at', 'updated_at'], 'integer'],
            [['title_ru', 'title_uz'], 'string', 'max' => 255],
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
            'path' => Yii::t('app', 'Image'),
            'url' => Yii::t('app', 'Url'),
            'title_ru' => Yii::t('app', 'Title Ru'),
            'title_uz' => Yii::t('app', 'Title En'),
            'content_ru' => Yii::t('app', 'Content Ru'),
            'content_uz' => Yii::t('app', 'Content En'),
            'order' => Yii::t('app', 'Order'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getTitle(){

        if (Yii::$app->language == 'ru'):  return $this->title_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->title_uz;

        endif;
    }

    public function getContent(){

        if (Yii::$app->language == 'ru'):  return $this->content_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->content_uz;

        endif;
    }

}
