<?php

namespace backend\controllers;

use backend\models\Category;
use Yii;
use backend\models\PendingDefaultCategoryName;
use backend\models\PendingDefaultCategoryNameSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PendingDefaultCategoryNameController implements the CRUD actions for PendingDefaultCategoryName model.
 */
class PendingDefaultCategoryNameController extends Controller
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
                        'actions' => ['delete','index','view','accept'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all PendingDefaultCategoryName models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PendingDefaultCategoryNameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PendingDefaultCategoryName model.
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

    public function actionAccept($id){
        $model = $this->findModel($id);
        $model->status ='active';
        $model->save();

        $category = new Category();
        $category->name = $model->name;
        $category->shop_id = Category::DEFAULT_SHOP_ID;
        $category->save();

        return $this->render('view', [
            'model' => $model,
        ]);
    }



    /**
     * Deletes an existing PendingDefaultCategoryName model.
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
     * Finds the PendingDefaultCategoryName model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PendingDefaultCategoryName the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PendingDefaultCategoryName::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
