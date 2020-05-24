<?php

use common\helper\Constants;
use frontend\models\ItemSearch;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $shop backend\models\Shop */

$this->title = Yii::t(Constants::APP, 'category.title');
$this->params['breadcrumbs'][] = ['label' => Yii::t(Constants::APP, 'site.view.my_shops'), 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = ['label' => $shop->name, 'url' => ['shop/view?id=' . $shop->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?=Html::encode($this->title)?></h1>

    <p>
        <?=Html::a(Yii::t(Constants::APP, 'category.add_btn'), ['create'], ['class' => 'btn btn-success'])?>
    </p>
    <div class="form-group">
        <?=Html::submitButton(Yii::t(Constants::APP, 'category.add_name_btn'), ['value' => Url::to(['category/add-category-name']), 'class' => 'addNameBtn btn btn-primary'])?>
    </div>

    <?php
    Modal::begin([
        'header' => '<h4 class="text-center">' . Yii::t(Constants::APP, 'category.add_name_btn') . '</h4>',
        'id' => 'myModal',
        'size' => 'modal-sm',
    ]);

    echo "<div id='myModalContent'></div>";

    Modal::end();

    ?>

    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>


</div>
