<?php

namespace frontend\models;

class SerachItem extends Model
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
            'item_name' => 'Item Name',
            'shop_rate' => 'Shop Rate',
            'near_by_shop' => 'Nearest Shops',
            'lowest_price' => 'Lowest Price',
        ];
    }
}