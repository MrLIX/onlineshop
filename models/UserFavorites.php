<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_favorites".
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 *
 * @property Products $product
 * @property User $user
 */
class UserFavorites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_favorites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'user_id'], 'required'],
            [['product_id', 'user_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /*
     * Add Product to Favorites from class .add-favorites
     * */
    public function addFavorites($product_id){

        $favorites = Yii::$app->session['favorites'];
        $k = 0;
        if(!empty($favorites)):
            foreach ($favorites as $item){
                if($item == $product_id){ // Если нет в сессии
                   $k = 1;
                }
            }
        endif;
        if($k == 0){
            $_SESSION['favorites'][] = $product_id;
            return true;
        } else{
            return false;
        }
    }

    /*
     * Delete Product from Favorites from class .del-favorites
     * */
    public function delFavorites($product_id){
        $favorites = $_SESSION['favorites'];

        foreach ($favorites as $k => $item){
            if($item == $product_id){
                unset($_SESSION['favorites'][$k]);  // Если есть продукт удаляем элемент
            }
        }
    }
}
