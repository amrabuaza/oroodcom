<?php

namespace backend\models;

use backend\models\translations\CategoryLanguage;
use common\helper\Constants;
use omgdef\multilingual\MultilingualBehavior;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $name_ar
 * @property int $shop_id
 *
 * @property Shop $shop
 * @property Item[] $items
 * @property CategoryLanguage $categoryLanguages
 */
class Category extends \yii\db\ActiveRecord
{

    const DEFAULT_SHOP_ID = "1";

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'shop_id'], 'required'],
            [['id', 'shop_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['shop_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            'ml' => [
                'class' => MultilingualBehavior::className(),
                'languages' => Yii::$app->params["languages"],
                'languageField' => 'language',
                'dynamicLangClass' => true,
                'langClassName' => CategoryLanguage::className(), // or namespace/for/a/class/PostLang
                'defaultLanguage' => 'en-US',
                'langForeignKey' => 'category_id',
                'tableName' => "{{%category_language}}",
                'attributes' => [
                    'name',
                ]
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t(Constants::APP, 'category.fields.name'),
            'shop_id' => 'Shop ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id']);
    }


    /**
     * Gets query for [[CategoryLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryLanguages()
    {
        return $this->hasOne(CategoryLanguage::className(), ['category_id' => 'id']);
    }

}
