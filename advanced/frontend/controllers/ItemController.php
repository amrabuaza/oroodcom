<?php

namespace frontend\controllers;

use backend\models\Shop;
use backend\models\translations\ItemLanguage;
use common\helper\Constants;
use common\helper\HelperMethods;
use Yii;
use backend\models\Item;
use frontend\models\ItemSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
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
                        'actions' => ['create', 'delete', 'index', 'view', 'update', 'add-translations', 'update-translations',],
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
     * Lists all Item models.
     * @param null $shop_id
     * @return mixed
     */
    public function actionIndex($shop_id = null)
    {
        if ($shop_id != null) {
            HelperMethods::setShopIdIntoSession($shop_id);
        } else {
            $shop_id = HelperMethods::getShopIdSession();
        }
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $shop_id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "shop" => Shop::findOne($shop_id)
        ]);
    }

    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            "shop" => Shop::findOne(HelperMethods::getShopIdSession())
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstanceByName("Item[upload_image]");
            if ($image != null) {
                $currentDate = date('Y-m');
                $this->createDirectoryOfCurrentMonthIfNotExists($currentDate);
                $model->picture = $currentDate . "/" . Yii::$app->security->generateRandomString() . '.' . $image->extension;
            }
            if ($model->validate() && $model->save()) {
                ItemLanguage::deleteAll(['item_id' => $model->id]);
                $image->saveAs("uploads/items/" . $model->picture);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            "shop" => Shop::findOne(HelperMethods::getShopIdSession())
        ]);
    }

    /**
     * Updates an existing Item model.
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
            $image = UploadedFile::getInstanceByName("Item[upload_image]");
            if ($image != null) {
                $currentDate = date('Y-m');
                $this->createDirectoryOfCurrentMonthIfNotExists($currentDate);
                $model->picture = $currentDate . "/" . Yii::$app->security->generateRandomString() . '.' . $image->extension;
            }
            if ($model->validate() && $model->save()) {
                $image->saveAs("uploads/items/" . $model->picture);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        Yii::$app->language = HelperMethods::getLanguageFromSessionOrSetIfNotExists();
        return $this->render('update', [
            'model' => $model,
            "shop" => Shop::findOne(HelperMethods::getShopIdSession())
        ]);
    }

    public function actionAddTranslations($id)
    {
        $model = new ItemLanguage();
        $model->item_id = $id;
        $model->language = Constants::ARABIC_LANGUAGE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('translations', [
            'model' => $model,
            "shop" => Shop::findOne(HelperMethods::getShopIdSession())
        ]);
    }

    public function actionUpdateTranslations($id)
    {
        $model = ItemLanguage::findOne(["item_id" => $id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('translations', [
            'model' => $model,
            "shop" => Shop::findOne(HelperMethods::getShopIdSession())
        ]);
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    private function createDirectoryOfCurrentMonthIfNotExists($currentDate)
    {
        if (!file_exists("uploads/items/" . $currentDate)) {
            mkdir("uploads/items/" . $currentDate);
        }
    }
}
