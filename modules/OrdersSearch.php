<?php

namespace app\modules;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form of `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'amount', 'state', 'delivery_time_id', 'payment_id', 'created_at', 'updated_at', 'region_id'], 'integer'],
            [['name', 'phone', 'street', 'index', 'number_dom', 'number_kv', 'lat', 'lang'], 'safe'],
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
        $query = Orders::find();

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
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'state' => $this->state,
            'delivery_time_id' => $this->delivery_time_id,
            'payment_id' => $this->payment_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'region_id' => $this->region_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'index', $this->index])
            ->andFilterWhere(['like', 'number_dom', $this->number_dom])
            ->andFilterWhere(['like', 'number_kv', $this->number_kv])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'lang', $this->lang]);

        return $dataProvider;
    }
}
