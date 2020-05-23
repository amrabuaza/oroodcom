<?php

namespace backend\controllers;

use Yii;
use backend\models\Shop;
use backend\models\ShopSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
                        'actions' => ['create','delete','index','view','update','activate','deactivate'],
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
    public function actionIndex($status = null)
    {
        $searchModel = new ShopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$status);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

    public function actionActivate($id){
        $model = $this->findModel($id);
        $model->status ='active';
        $model->save();

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionDeactivate($id){
        $model = $this->findModel($id);
        $model->status ='inactive';
        $model->save();

        return $this->render('view', [
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
        $model = new Shop();

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstanceByName("Shop[upload_image]");
            if ($image != null) {
                $modelName = $model->name . '_' . $model->id . '_';
                $model->picture = $modelName . $image->baseName . '.' . $image->extension;
            }


            if($model->save()){
                if ($image != null) {
                    $image->saveAs('/oroodcom/advanced/frontend/web/uploads/' . $model->picture);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
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

        if ($model->load(Yii::$app->request->post()) ) {

            $image = UploadedFile::getInstanceByName("Shop[upload_image]");
            if ($image != null) {
                $modelName = $model->name . '_' . $model->id . '_';
                $model->picture = $modelName . $image->baseName . '.' . $image->extension;
            }

            if($model->save()){
                if ($image != null) {
                    $image->saveAs('/oroodcom/advanced/frontend/web/uploads/' . $model->picture);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                print_r($model->errors);
                die("x");
            }
        }

        return $this->render('update', [
            'model' => $model,
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

    /**
     * Finds the Shop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Shop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Shop::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
