<?php

use frontend\models\ItemSearch;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = ['label' => 'My shops', 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="form-group">
        <?= Html::submitButton('Add Category Name', ['value' => Url::to(['category/add-category-name']), 'class' => 'addNameBtn btn btn-primary']) ?>
    </div>

    <?php
    Modal::begin([
        'header' => '<h4>Add Category Name</h4>',
        'id' => 'myModal',
        'size' => 'modal-sm',
    ]);

    echo "<div id='myModalContent'></div>";

    Modal::end();

    ?>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value'=> function($model,$key,$index,$column)
                {
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=> function($model,$key,$index,$column)
                {
                    $searchModel = new ItemSearch();
                    $searchModel->category_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_item',[
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                },
            ],
            'name',
            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>


</div>
