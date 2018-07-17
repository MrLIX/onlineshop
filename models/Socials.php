<?php

namespace app\models;

use app\components\FileUploadBehaviour;
use Yii;

/**
 * This is the model class for table "socials".
 *
 * @property int $id
 * @property string $base_url
 * @property string $path
 * @property string $url
 * @property int $status
 * @property int $order
 */
class Socials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'socials';
    }

    public function behaviors()
    {
        return [
            'class' => FileUploadBehaviour::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'order'], 'integer'],
            [[ 'url'], 'string', 'max' => 255],
            [['path'],'string']
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
            'order' => Yii::t('app', 'Order'),
        ];
    }
}
