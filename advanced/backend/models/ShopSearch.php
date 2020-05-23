<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Shop;

/**
 * ShopSearch represents the model behind the search form of `backend\models\Shop`.
 */
class ShopSearch extends Shop
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'phone_number', 'rate', 'owner_id'], 'integer'],
            [['name', 'description', 'latitude', 'longitude', 'open_at', 'close_at', 'status'], 'safe'],
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
    public function search($params, $status)
    {
        if (isset($status)) {
            $query = Shop::find()->where(["status" => $status]);
        } else {
            $query = Shop::find();
        }


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
            'phone_number' => $this->phone_number,
            'rate' => $this->rate,
            'owner_id' => $this->owner_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'open_at', $this->open_at])
            ->andFilterWhere(['like', 'close_at', $this->close_at])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
