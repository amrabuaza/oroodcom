<?php

namespace frontend\controllers;

use backend\models\Shop;
use backend\models\translations\ShopLanguage;
use common\helper\Constants;
use common\helper\HelperMethods;
use frontend\models\ShopSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ShopController implements the CRUD actions for Shop model.
 */
class ShopController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['info'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['create', 'delete', 'index', 'view', 'update', 'info'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
            return false;

        $language = HelperMethods::getLanguageFromSessionOrSetIfNotExists();
        Yii::$app->language = $language;
        Yii::$app->sourceLanguage = $language;

        if ($language == Constants::ARABIC_LANGUAGE) {
            $this->layout = "main-ar";
        }

        return true;
    }

    /**
     * Lists all Shop models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShopSearch();
        $shops = Shop::find()->where(['owner_id' => Yii::$app->user->id])->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $shops,
        ]);
    }

    /**
     * Displays a single Shop model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Shop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Shop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Shop::findOne($id)) !== null && $model->owner_id == Yii::$app->user->id) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionInfo($id)
    {
        $model = Shop::findOne($id);
        return $this->render('info', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Shop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $longitude = 35.851479;
        $latitude = 32.551445;
        $model = new Shop();

        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstanceByName("Shop[upload_image]");
            if ($image != null) {
                $currentDate = date('Y-m');
                $this->createDirectoryOfCurrentMonthIfNotExists($currentDate);
                $model->picture = $currentDate . "/" . Yii::$app->security->generateRandomString() . '.' . $image->extension;
            }

            if ($model->save()) {
                if ($image != null) {
                    $image->saveAs('uploads/shops/' . $model->picture);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
            'longitude' => $longitude,
            'latitude' => $latitude,
        ]);
    }

    /**
     * Updates an existing Shop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException|\yii\base\Exception if the model cannot be found
     */
    public function actionUpdate($id)
    {
        Yii::$app->language = Constants::DEFAULT_LANGUAGE;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstanceByName("Shop[upload_image]");
            if ($image != null) {
                $currentDate = date('Y-m');
                $this->createDirectoryOfCurrentMonthIfNotExists($currentDate);
                $model->picture = $currentDate . "/" . Yii::$app->security->generateRandomString() . '.' . $image->extension;
            }

            if ($model->save()) {
                if ($image != null) {
                    $image->saveAs('uploads/shops/' . $model->picture);
                }
                if ($model->shopLanguage == null) {
                    $shopLanguage = new ShopLanguage();
                    $shopLanguage->shop_id = $model->id;
                    $shopLanguage->language = Constants::ARABIC_LANGUAGE;
                    $shopLanguage->name = $model->name_ar;
                    $shopLanguage->description = $model->description_ar;
                    $shopLanguage->save();
                } else {
                    $model->shopLanguage->name = $model->name_ar;
                    $model->shopLanguage->description = $model->description_ar;
                    $model->shopLanguage->save();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        Yii::$app->language = HelperMethods::getLanguageFromSessionOrSetIfNotExists();
        if ($model->shopLanguage != null) {
            $model->name_ar = $model->shopLanguage->name;
            $model->description_ar = $model->shopLanguage->description;
        } else {
            $model->name_ar = $model->description_ar = "";
        }

        return $this->render('update', [
            'model' => $model,
            'longitude' => $model->longitude,
            'latitude' => $model->latitude,
        ]);
    }

    /**
     * Deletes an existing Shop model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    private function createDirectoryOfCurrentMonthIfNotExists($currentDate)
    {
        if (!file_exists("uploads/shops/" . $currentDate)) {
            mkdir("uploads/shops/" . $currentDate);
        }
    }

}
