<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\About;

/**
 * AboutSearch represents the model behind the search form of `app\models\About`.
 */
class AboutSearch extends About
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title_ru', 'title_en', 'content_ru', 'content_en', 'param1_title_ru', 'param1_title_en', 'param1_content_ru', 'param1_content_en', 'param2_title_ru', 'param2_title_en', 'param2_content_ru', 'param2_content_en', 'param3_title_ru', 'param3_title_en', 'param3_content_en', 'param3_content_ru'], 'safe'],
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
        $query = About::find();

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
        ]);

        $query->andFilterWhere(['like', 'title_ru', $this->title_ru])
            ->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'content_ru', $this->content_ru])
            ->andFilterWhere(['like', 'content_en', $this->content_en])
            ->andFilterWhere(['like', 'param1_title_ru', $this->param1_title_ru])
            ->andFilterWhere(['like', 'param1_title_en', $this->param1_title_en])
            ->andFilterWhere(['like', 'param1_content_ru', $this->param1_content_ru])
            ->andFilterWhere(['like', 'param1_content_en', $this->param1_content_en])
            ->andFilterWhere(['like', 'param2_title_ru', $this->param2_title_ru])
            ->andFilterWhere(['like', 'param2_title_en', $this->param2_title_en])
            ->andFilterWhere(['like', 'param2_content_ru', $this->param2_content_ru])
            ->andFilterWhere(['like', 'param2_content_en', $this->param2_content_en])
            ->andFilterWhere(['like', 'param3_title_ru', $this->param3_title_ru])
            ->andFilterWhere(['like', 'param3_title_en', $this->param3_title_en])
            ->andFilterWhere(['like', 'param3_content_en', $this->param3_content_en])
            ->andFilterWhere(['like', 'param3_content_ru', $this->param3_content_ru]);

        return $dataProvider;
    }
}
