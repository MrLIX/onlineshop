<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "about".
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_en
 * @property string $content_ru
 * @property string $content_en
 * @property string $param1_title_ru
 * @property string $param1_title_en
 * @property string $param1_content_ru
 * @property string $param1_content_uz
 * @property string $param2_title_ru
 * @property string $param2_title_en
 * @property string $param2_content_ru
 * @property string $param2_content_en
 * @property string $param3_title_ru
 * @property string $param3_title_en
 * @property string $param3_content_en
 * @property string $param3_content_ru
 */
class About extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about';
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
            [['content_ru', 'content_en', 'param1_content_ru', 'param1_content_en', 'param2_content_ru', 'param2_content_en', 'param3_content_en', 'param3_content_ru'], 'string'],
            [['title_ru', 'title_en', 'param1_title_ru', 'param1_title_en', 'param2_title_ru', 'param2_title_en', 'param3_title_ru', 'param3_title_en'], 'string', 'max' => 255],
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
            'content_ru' => Yii::t('app', 'Content Ru'),
            'content_en' => Yii::t('app', 'Content En'),
            'param1_title_ru' => Yii::t('app', 'Param1 Title Ru'),
            'param1_title_en' => Yii::t('app', 'Param1 Title En'),
            'param1_content_ru' => Yii::t('app', 'Param1 Content Ru'),
            'param1_content_en' => Yii::t('app', 'Param1 Content En'),
            'param2_title_ru' => Yii::t('app', 'Param2 Title Ru'),
            'param2_title_en' => Yii::t('app', 'Param2 Title En'),
            'param2_content_ru' => Yii::t('app', 'Param2 Content Ru'),
            'param2_content_en' => Yii::t('app', 'Param2 Content En'),
            'param3_title_ru' => Yii::t('app', 'Param3 Title Ru'),
            'param3_title_en' => Yii::t('app', 'Param3 Title En'),
            'param3_content_en' => Yii::t('app', 'Param3 Content En'),
            'param3_content_ru' => Yii::t('app', 'Param3 Content Ru'),
            'path' => Yii::t('app', 'Image'),
        ];
    }
    public function getParam1Title(){

        if (Yii::$app->language == 'ru'):  return $this->param1_title_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->param1_title_en;

        endif;
    }
    public function getParam1Content(){

        if (Yii::$app->language == 'ru'):  return $this->param1_content_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->param1_content_en;

        endif;
    }
    public function getParam2Title(){

        if (Yii::$app->language == 'ru'):  return $this->param2_title_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->param2_title_en;

        endif;
    }
    public function getParam2Content(){

        if (Yii::$app->language == 'ru'):  return $this->param2_content_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->param2_content_en;

        endif;
    }
    public function getParam3Title(){

        if (Yii::$app->language == 'ru'):  return $this->param3_title_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->param3_title_en;

        endif;
    }
    public function getParam3Content(){

        if (Yii::$app->language == 'ru'):  return $this->param3_content_ru;

        endif;
        if (Yii::$app->language == 'en'):  return $this->param3_content_en;

        endif;
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
