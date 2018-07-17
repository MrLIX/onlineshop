<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "our_service".
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_en
 * @property string $path
 * @property string $content_ru
 * @property string $content_en
 */
class OurService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'our_service';
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
            [['content_ru', 'content_en'], 'string'],
            [['title_ru', 'title_en'], 'string', 'max' => 255],
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
            'title_ru' => Yii::t('app', 'Title Ru'),
            'title_en' => Yii::t('app', 'Title En'),
            'path' => Yii::t('app', 'Image'),
            'content_ru' => Yii::t('app', 'Content Ru'),
            'content_en' => Yii::t('app', 'Content En'),
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
