<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderProducts as OrderProductsModel;

/**
 * OrderProducts represents the model behind the search form of `app\models\OrderProducts`.
 */
class OrderProducts extends OrderProductsModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'orders_id', 'product_id', 'quantity', 'discount', 'product_price', 'status'], 'integer'],
            [['color', 'type'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = OrderProductsModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'orders_id' => $this->orders_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'discount' => $this->discount,
            'product_price' => $this->product_price,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
