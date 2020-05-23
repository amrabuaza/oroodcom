<?php

namespace backend\models\translations;

use backend\models\Shop;
use Yii;

/**
 * This is the model class for table "shop_language".
 *
 * @property int $id
 * @property string $language
 * @property string $name
 * @property string $description
 * @property int $shop_id
 *
 * @property Shop $shop
 */
class ShopLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language', 'name', 'description', 'shop_id'], 'required'],
            [['shop_id'], 'integer'],
            [['language', 'name', 'description'], 'string', 'max' => 255],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['shop_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language' => 'Language',
            'name' => 'Name',
            'description' => 'Description',
            'shop_id' => 'Shop ID',
        ];
    }

    /**
     * Gets query for [[Shop]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }
}
