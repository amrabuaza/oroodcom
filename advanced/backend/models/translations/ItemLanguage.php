<?php

namespace backend\models\translations;

use backend\models\Item;
use common\helper\Constants;
use Yii;

/**
 * This is the model class for table "item_language".
 *
 * @property int $id
 * @property string $language
 * @property string $name
 * @property string $description
 * @property int $item_id
 *
 * @property Item $item
 */
class ItemLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language', 'name', 'description', 'item_id'], 'required'],
            [['item_id'], 'integer'],
            [['language', 'name', 'description'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
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
            'name' => Yii::t(Constants::APP, 'item.fields.name_ar'),
            'description' => Yii::t(Constants::APP, 'item.fields.description_ar'),
            'item_id' => 'Item ID',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }
}
