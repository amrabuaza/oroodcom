<?php

namespace frontend\models;

use common\helper\Constants;
use Yii;

class SearchItem extends Model
{
    public $latitude;
    public $longitude;
    public $item_name;
    public $shop_rate;
    public $near_by_shop;
    public $lowest_price;


    public function rules()
    {
        return [
            [['item_name'], 'required'],
            [['item_name'], 'string'],
            [['shop_rate'], 'integer'],
            [['item_name', 'shop_rate', 'near_by_shop', 'lowest_price', 'longitude', 'latitude'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'item_name' => Yii::t(Constants::APP, 'item.search.fields.item_name'),
            'shop_rate' => Yii::t(Constants::APP, 'item.search.fields.shop_rate'),
            'near_by_shop' => Yii::t(Constants::APP, 'item.search.fields.nearest_shops'),
            'lowest_price' => Yii::t(Constants::APP, 'item.search.fields.lowest_price'),
        ];
    }
}