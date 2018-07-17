<?php

namespace app\models;

use app\components\FileUploadBehaviour;
use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $base_url
 * @property string $path
 * @property string $title_ru
 * @property string $title_uz
 * @property int $status
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }
    public function behaviors()
    {
        return [
            [
                'class' => FileUploadBehaviour::className(),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_ru', 'title_uz'], 'required'],
            [['status'], 'integer'],
            [['title_ru', 'title_uz'], 'string', 'max' => 255],
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
            'path' => Yii::t('app', 'Image'),
            'title_ru' => Yii::t('app', 'Title Ru'),
            'title_uz' => Yii::t('app', 'Title EN'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getTitle(){

        if (Yii::$app->language == 'ru'):  return $this->title_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->title_uz;

        endif;
    }
}
