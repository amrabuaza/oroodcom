<?php

namespace frontend\controllers;

use backend\models\Category;
use backend\models\Item;
use backend\models\PendingDefaultCategoryName;
use backend\models\Shop;
use common\helper\Constants;
use common\helper\HelperMethods;
use frontend\models\CategorySearch;
use frontend\models\Model;
use Yii;
use yii\base\Exception as ExceptionAlias;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
                        'actions' => ['create', 'delete', 'index', 'view', 'update', 'add-category-name'],
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
     * Lists all Category models.
     * @param null $id
     * @return mixed
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionIndex($id = null)
    {

        if ($id != null) {
            HelperMethods::setShopIdIntoSession($id);
        } else {
            $id = HelperMethods::getShopIdSession();
        }

        $userId = Yii::$app->user->id;
        $query = PendingDefaultCategoryName::find()->where(["user_id" => $userId]);
        $query->andWhere(["status" => "active"]);

        if ($query->count() != 0) {
            $message = Yii::t(Constants::APP, 'category.added_message_1');


            if ($query->count() > 1) {
                $message = Yii::t(Constants::APP, 'category.added_message_2');
            }

            $count = 0;
            $message = $message . "(";
            foreach ($query->all() as $model) {

                if ($count + 1 == $query->count()) {
                    $message = $message . $model->name;
                } else {
                    $message = $message . $model->name . " , ";
                }

                $model->delete();
            }
            $message = $message . ")";

            Yii::$app->session->setFlash('success', $message);

        }

        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "shop" => Shop::findOne($id)
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            "shop" => Shop::findOne($model->shop_id)
        ]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            $id_shop = $model->shop_id;
            $shop = Shop::findOne($id_shop);
            if ($shop->owner_id == Yii::$app->user->id)
                return $model;
            else
                throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddCategoryName()
    {
        $model = new PendingDefaultCategoryName();
        $model->user_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', Yii::t(Constants::APP, 'category.add_message'));
            $searchModel = new CategorySearch();

            $session = Yii::$app->session;
            $id = $session->get('shop_id');

            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->renderAjax('add-category-name', [
                'model' => $model
            ]);
        }
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $model->shop_id = HelperMethods::getShopIdSession();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            "shop" => Shop::findOne($model->shop_id)
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            "shop" => Shop::findOne($model->shop_id)
        ]);
    }

    /**
     * Deletes an existing Category model.
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

}
