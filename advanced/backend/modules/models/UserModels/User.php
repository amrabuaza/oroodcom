<?php

namespace backend\modules\models\UserModels;

use backend\models\Country;
use backend\models\Transaction;
use backend\models\Transfer;
use backend\models\UserAddress;
use backend\models\UserOrder;
use backend\models\UserOrderHestory;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $type
 * @property string $access_token
 */
class User extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = 9;
    const STATUS_ACTIVE = 10;
    public $password;

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!$this->isNewRecord) {
                $this->updated_at = date("Y-m-d H:i:s");
                if (isset($this->password)) {
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
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email',], 'required'],
            [['status'], 'integer'],
            [['birth_date', 'created_at', 'updated_at'], 'safe'],
            [['type', ], 'string'],
            [['password', 'first_name', 'last_name', 'access_token'], 'string'],
            [['username', 'first_name', 'last_name', 'auth_key', 'password_hash', 'password_reset_token', 'email',  'access_token'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'type' => 'Type',
        ];
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAccessToken()
    {
        $this->access_token = bin2hex(random_bytes(32));
    }

}
