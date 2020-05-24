<?php

namespace backend\models;

use common\helper\Constants;
use Yii;

/**
 * This is the model class for table "pending_default_category_name".
 *
 * @property int $id
 * @property string $name
 * @property string $name_ar
 * @property string $status
 * @property int $user_id
 *
 * @property User $user
 */
class PendingDefaultCategoryName extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pending_default_category_name';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name',"name_ar"], 'required'],
            [['status'], 'string'],
            [['user_id'], 'integer'],
            [['name','name_ar'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'name_ar' => Yii::t(Constants::APP, 'category.fields.name_ar'),
            'status' => 'Status',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
