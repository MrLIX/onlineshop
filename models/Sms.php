<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sms".
 *
 * @property int $id
 * @property string $phone
 * @property string $sms
 * @property int $try_count
 * @property int $send_at
 */
class Sms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['try_count', 'send_at'], 'integer'],
            [['phone', 'sms'], 'string', 'max' => 255],
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
            'sms' => Yii::t('app', 'Sms'),
            'try_count' => Yii::t('app', 'Try Count'),
            'send_at' => Yii::t('app', 'Send At'),
        ];
    }

    public function sendSMS($code,$phone)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://185.8.212.184/smsgateway/');
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_POSTFIELDS,
            'login=' . urlencode('LOGIN').
            '&password=' . urlencode('PASSWORD').
            '&nickname=' . urlencode('test') .
            '&data=' . urlencode('[ 
                {
                    "phone": '.$phone.', 
                    "text": "Ваш код для регистрации: ' . $code . '"
                } 
            ]'));

        curl_setopt($curl, CURLOPT_USERAGENT, 'Opera 10.00');
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
}
