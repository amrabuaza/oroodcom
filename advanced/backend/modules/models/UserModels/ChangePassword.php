<?php

namespace backend\modules\models\UserModels;

use Yii;
use yii\base\Model;

class ChangePassword extends Model
{

    public $access_token;
    public $old_password;
    public $new_password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['access_token', 'old_password', 'new_password'], 'required'],
            [['old_password'], 'string'],
            [['email', 'old_password', 'new_password'], 'safe'],
            ['new_password', 'string', 'min' => 6],
        ];
    }

    public function save()
    {
        if ($this->validate() && $this->isPasswordMatch()) {
            $user = User::findOne(['access_token' => $this->access_token]);
            $user->setPassword($this->new_password);
            return $user->save();
        }
        return false;
    }


    public function isPasswordMatch()
    {
        if (isset($this->old_password) && isset($this->new_password)) {
            $user = User::findOne(['access_token' => $this->access_token]);
            return Yii::$app->security->validatePassword($this->old_password, $user->password_hash);
        }
        return false;
    }

}