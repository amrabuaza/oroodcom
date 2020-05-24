<?php

use common\helper\Constants;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $shop backend\models\Shop */

$this->title = Yii::t(Constants::APP, 'item.title');
$this->params['breadcrumbs'][] = ['label' => Yii::t(Constants::APP, 'site.view.my_shops'), 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = ['label' => $shop->name, 'url' => ['shop/view?id=' . $shop->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?=Html::encode($this->title)?></h1>

    <p>
        <?=Html::a(Yii::t(Constants::APP, 'item.add_btn'), ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'price',
            'old_price',
            'description',
            [
                'attribute' => Yii::t(Constants::APP, 'item.fields.category'),
                'value' => function ($model, $key, $index, $column) {
                    return $model->category->name;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>


</div>
