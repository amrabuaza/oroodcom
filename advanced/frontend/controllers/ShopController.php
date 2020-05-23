<?php

namespace frontend\controllers;

use backend\models\Shop;
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

        if ($model->load(Yii::$app->request->post()) ) {

            $image = UploadedFile::getInstanceByName("Shop[upload_image]");
            if ($image != null) {
                $modelName = $model->name . '_' . $this->guid() . '_';
                $model->picture = $modelName . $image->baseName . '.' . $image->extension;
            }

            if($model->save()){
                if ($image != null) {
                    $image->saveAs('uploads/' . $model->picture);
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
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstanceByName("Shop[upload_image]");
            if ($image != null) {
                $modelName = $model->name . '_' . $model->id . '_';
                $model->picture = $modelName . $image->baseName . '.' . $image->extension;
            }


            if($model->save()){
                if ($image != null) {
                    $image->saveAs('uploads/' . $model->picture);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

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

    private

    function guid()
    {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
