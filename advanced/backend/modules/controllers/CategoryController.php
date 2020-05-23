<?php

namespace backend\modules\controllers;

use backend\modules\models\Category;
use yii\db\Query;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;

class CategoryController extends ActiveController
{

    public $modelClass = 'backend\modules\models\Category';

    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['view']);
        unset($actions['delete']);
        return $actions;
    }

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

        $behaviors['authenticator'] = [
            'class' =>  HttpBearerAuth::className(),
            'except' => ['options'],
        ];

        return $behaviors;
    }

    public function actionGetAll()
    {
        $query = new Query();
        $categories = $query->select(['name'])
            ->from('category')
            ->distinct()
            ->all();
        return $categories;
    }

}