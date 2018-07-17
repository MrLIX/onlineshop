<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_method".
 *
 * @property int $id
 * @property string $base_url
 * @property string $path
 * @property int $status
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_method';
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
            [['name'], 'string'],
            //[['base_url', 'path'], 'string', 'max' => 255],
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
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
