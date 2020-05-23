<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'shop_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
