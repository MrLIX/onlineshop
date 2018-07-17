<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partners".
 *
 * @property int $id
 * @property string $base_url
 * @property string $path
 * @property string $url
 * @property int $status
 */
class Partners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partners';
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
            [['status'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['path'],'file']
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
            'url' => Yii::t('app', 'Url'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
