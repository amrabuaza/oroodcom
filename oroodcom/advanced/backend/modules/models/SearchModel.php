<?php

namespace backend\modules\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class SearchModel extends Item
{
    public $shopRate;
    public $lowestPrice;
    public $latitude;
    public $longitude;
    public $nearByShop;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['shopRate', 'lowestPrice', 'name', 'description', 'picture', 'longitude', 'latitude', 'nearByShop'], 'safe'],
            [['price', 'old_price'], 'number'],
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
        $query = Item::find();

        $query->joinWith("shop");
        $query->andWhere(["shop.status" => "active"]);

        if ($this->nearByShop == 1) {
            $query->select(['item.*', '(POW(69.1 * (shop.latitude - ' . $this->latitude . '), 2) + POW(69.1 * (' . $this->longitude . ' - shop.longitude) * COS(shop.latitude / 57.3), 2)) AS distance'])
                ->andWhere(['IS NOT', 'shop.longitude', null])
                ->andWhere(['IS NOT', 'shop.latitude', null])
                ->orderBy(['distance' => SORT_ASC])
                ->limit(5)
                ->all();
        }

        // add conditions that should always apply here
        if ($this->lowestPrice == 1) {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => [
                    'defaultOrder' => [
                        'price' => SORT_ASC,
                    ]
                ],
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }


        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'item.name', $this->name])
            ->andFilterWhere(['=', 'shop.rate', $this->shopRate]);

        return $dataProvider;
    }
}
