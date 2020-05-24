<?php

namespace backend\modules\controllers;

use backend\modules\models\Category;
use backend\modules\models\Item;
use backend\modules\models\SearchModel;
use frontend\models\SearchItem;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;

class ItemController extends ActiveController
{

    public $modelClass = 'backend\modules\models\Item';

    public function actions()
    {
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
            'class' => HttpBearerAuth::className(),
            'except' => ['options'],
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'get-latest-items' => ['GET'],
                'get-items-by-category-name' => ['GET'],
                'search' => ['POST'],
            ]
        ];

        return $behaviors;
    }


    public function actionGetLatestItems()
    {
        $query = Item::find()->orderBy(['id' => SORT_DESC])->limit(10);
        $items = $query->joinWith("shop")->where(["shop.status" => "active"])->all();
        return $items;
    }

    public function actionGetItemsByCategoryName($category_name)
    {
        $categories = Category::find()->where(['like', 'name', $category_name])->all();
        $query = Item::find();
        foreach ($categories as $category) {
            $query->orWhere(["category_id" => $category->id]);
        }

        $query->joinWith("shop");
        $items = $query->andWhere(["shop.status" => "active"])->all();
        return $items;
    }


    public function actionSearch()
    {
        $model = new SearchItem();

        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            $searchModel = new SearchModel();
            $searchModel->name = $model->item_name;


            if (isset($model->shop_rate)) {
                $searchModel->shopRate = $model->shop_rate;
            }

            if (isset($model->lowest_price)) {
                $searchModel->lowestPrice = $model->lowest_price;
            }else{
                $searchModel->lowestPrice = 0;
            }

            if (isset($model->longitude) && isset($model->latitude)) {
                $searchModel->longitude = $model->longitude;
                $searchModel->latitude = $model->latitude;
                $searchModel->nearByShop = 1;
            }else{
                $searchModel->nearByShop = 0;
            }

            $items = $searchModel->search(Yii::$app->request->queryParams)->models;
            return $items;
        } else {
            $model->validate();
            return $model;
        }

    }

}