<?php

namespace backend\modules\controllers;

use backend\modules\models\SignupForm;
use backend\modules\models\UserModels\User;
use common\models\LoginForm;
use Yii;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\rest\Controller;

class AuthorizationController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'login' => ['POST'],
                'signup' => ['POST']
            ]
        ];

        return $behaviors;
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->type = "user";
        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
            $user = User::findOne(["username" => $model->username]);
            $user->generateAccessToken();
            $user->save();
            return ['access_token' => $user->access_token];
        }
        $model->validate();
        return $model;
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->signup()) {
            $user = User::findOne(["username" => $model->username]);
            return ['access_token' => $user->access_token];
        } else {
            Yii::$app->response->statusCode = 422;
            $model->validate();
            return $model;
        }
    }

}