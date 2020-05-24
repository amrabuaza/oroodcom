<?php

namespace backend\models;

use common\helper\Constants;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $type
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 *
 * @property Shop[] $shops
 */
class User extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 9;
    const STATUS_ACTIVE = 10;
    public $password;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!$this->isNewRecord) {
                $this->updated_at = date("Y-m-d H:i:s");
                if ($this->password != NULL) {
                    $this->setPassword($this->password);
                    return true;
                }
            } else if ($this->isNewRecord) {
                $this->created_at = date("Y-m-d H:i:s");
            }
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email'], 'required'],
            [['type'], 'string'],
            [['status'], 'integer'],
            [['password'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t(Constants::APP, 'site.view.username'),
            'email' => Yii::t(Constants::APP, 'site.sign_up.email'),
            'password' => Yii::t(Constants::APP, 'site.view.password'),
            'type' => 'Type',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShops()
    {
        return $this->hasMany(Shop::className(), ['owner_id' => 'id']);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}
