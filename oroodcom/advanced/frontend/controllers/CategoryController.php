<?php

namespace frontend\controllers;

use backend\models\Category;
use backend\models\Item;
use backend\models\PendingDefaultCategoryName;
use backend\models\Shop;
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

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        $session = Yii::$app->session;
        if ($id != null) {
            $session->set('shop_id', $id);
        } else if (isset($_SESSION['shop_id'])) {
            $id = $session->get('shop_id');
        }

        $userId = Yii::$app->user->id;
        $query = PendingDefaultCategoryName::find()->where(["user_id" => $userId]);
        $query->andWhere(["status" => "active"]);

        if ($query->count() != 0) {
            $message = "Admin accepted the category name";


            if ($query->count() > 1) {
                $message = $message . "s ";
            }

            $count = 0;
            $message = $message . "(";
            foreach ($query->all() as $model) {

                if($count+1 == $query->count()){
                    $message = $message . $model->name;
                }else{
                    $message = $message . $model->name." , ";
                }

                $model->delete();
            }
            $message = $message . ")";

            Yii::$app->session->setFlash('success',$message);

        }

        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
            Yii::$app->session->setFlash('success', 'Thank you for adding category name. We will accepted it as soon as possible.');
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
        $modelsItems = [new Item];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelsItems = Model::createMultiple(Item::classname());
            Model::loadMultiple($modelsItems, Yii::$app->request->post());
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsItems) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {

                    if ($flag = $model->save(false)) {
                        foreach ($modelsItems as $index => $modelItem) {
                            $image = UploadedFile::getInstanceByName("Item[" . $index . "][upload_image]");
                            if ($image != null) {
                                $modelName = $modelItem->name . '_' . $this->guid() . '_';
                                $modelItem->picture = $modelName . $image->baseName . '.' . $image->extension;
                            }
                            $modelItem->category_id = $model->id;
                            if (!($flag = $modelItem->save(false))) {

                                $transaction->rollBack();
                                break;
                            }

                            if ($image != null) {
                                $image->saveAs('uploads/' . $modelItem->picture);
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    echo($e);
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsItems' => (empty($modelsItems)) ? [new Item] : $modelsItems,
            ]);
        }
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
        $modelsItems = $model->items;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $oldIDs = ArrayHelper::map($modelsItems, 'id', 'id');
            $modelsItems = Model::createMultiple(Item::classname(), $modelsItems);
            Model::loadMultiple($modelsItems, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsItems, 'id', 'id')));
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsItems) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            Item::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsItems as $index => $modelItem) {
                            $modelItem->category_id = $model->id;
                            $image = UploadedFile::getInstanceByName("Item[" . $index . "][upload_image]");
                            if ($image != null) {
                                $modelName = $modelItem->name . '_' .$this->guid() . '_';
                                $modelItem->picture = $modelName . $image->baseName . '.' . $image->extension;
                            }


                            if (!($flag = $modelItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                            if ($image != null) {
                                $image->saveAs('uploads/' . $modelItem->picture);
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsItems' => $modelsItems,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
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

    function guid()
    {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

}
