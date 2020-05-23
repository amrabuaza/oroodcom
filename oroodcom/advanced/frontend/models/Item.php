<?php

namespace frontend\models;

use backend\models\Category;
use backend\models\Shop;
use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string $name
 * @property double $price
 * @property double $old_price
 * @property string $description
 * @property string $picture
 * @property int $category_id
 *
 * @property Category $category
 */
class Item extends \yii\db\ActiveRecord
{
    public $file;
    public $upload_image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name', 'price', 'old_price', 'description' ], 'required'],
            [['id', 'category_id'], 'integer'],
            [['price', 'old_price'], 'number'],
            [['name', 'description','picture'], 'string', 'max' => 255],
            [['upload_image'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
            [['id'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price after sale',
            'old_price' => 'Old Price',
            'description' => 'Description',
            'picture' => 'Picture',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id'])->via("category");
    }
}
